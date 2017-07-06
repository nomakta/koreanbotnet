using System;
using System.Collections.Specialized;
using System.Net;

namespace dongs
{
    public class dongclient : WebClient
    {
        public CookieContainer CookieContainer { get; private set; }

        public dongclient()
        {
            CookieContainer = new CookieContainer();
        }

        protected override WebRequest GetWebRequest(Uri address)
        {
            // Ignore Certificate validation failures (aka untrusted certificate + certificate chains)
            ServicePointManager.ServerCertificateValidationCallback = ((sender, certificate, chain, sslPolicyErrors) => true);

            var request = base.GetWebRequest(address);
            if (request is HttpWebRequest)
            {
                (request as HttpWebRequest).CookieContainer = CookieContainer;
            }
            return request;
        }

        internal byte[] UploadData(string v1, string v2, NameValueCollection command)
        {
            throw new NotImplementedException();
        }
    }
}
