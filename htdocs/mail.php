<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mailModal">
  Mail test
</button>

<!-- Modal -->
<div class="modal fade" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="mailModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mailModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        if( mail('mail@serversforhackers.com', 'Feedback', 'This is so useful, thanks!') )
        {
          echo '<div class="alert alert-success" role="alert">';
            echo "Mail Sent successfuly: ";
            echo '<a class="nav-link" href="http://localhost:8084">Go to local mailhog</a>';
          echo "</div>";
        }else{
          echo '<div class="alert alert-danger" role="alert">';
            echo "Mail don't sent!";
          echo "</div>";
        }
        ?>
      </div>
      <div class="modal-footer">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	<!--
        <button type="button" class="btn btn-primary">Save changes</button>
        -->
      </div>
    </div>
  </div>
</div>
