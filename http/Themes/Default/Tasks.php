
		<div class="container">

    </tr>
		<?php

		$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/panel 2/_conf/inc/connection.class.php";

		@include $path;

		$functions->ViewAllTasks();
		$functions->notLoggedIn();
?>

</table>
	<br><br>
<br><ol class="breadcrumb">

 <p> <input type="button"  name="AddTaskDialog" data-toggle="modal" data-target="#AddTask" class="btn btn-primary btn-xs" value="Add task"> </form></p>
      </ol>
  <div class="modal fade" id="AddTask" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add task</h4>
        </div>
        <div class="modal-body">
            <?php $functions->AddTask(); ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>


</div>
