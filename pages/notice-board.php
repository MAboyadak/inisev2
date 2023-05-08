
<?php 

require_once __DIR__.'/../controllers/NoticeboardController.php';
include_once __DIR__.'/../partials/header.php';

?>


<h2 class="text-center p-2 rounded bg-secondary text-white">ALl Messages</h2>


<?php if(isset($_SESSION['success'])) { ?>
    <div class="bg-success p-2 my-2 text-white">
        <?php echo $_SESSION['success'] ; ?>
    </div>
<?php unset($_SESSION['success']); } ?>


<?php if(isset($_SESSION['err'])) { ?>
    <div class="bg-danger text-white p-2 my-2">
        <?php echo $_SESSION['err'] ; ?>
    </div>
<?php unset($_SESSION['err']); } ?>

<div id="refresh-err" class="bg-danger text-white" style="display:none"></div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Subject</th>
            <th>Messages</th>
        </tr>
    </thead>
    <tbody id="messages">
        <?php
            $iteration = 1;
            foreach ($messages as $message) : 
        ?>

            <tr>
                <td><?php echo $iteration ; ?></td>
                <td><?php echo $message['subject'] ; ?></td>
                <td><?php echo $message['message'] ; ?></td>
            </tr>

        <?php
            $iteration ++;
            endforeach 
        ?>
    </tbody>
</table>

<script>


    let intervalId = setInterval(function(){
        getNewData();
    }, 2000)

    function getNewData(){
        fetch('/inisev2/refresh-data.php')
            .then(response => response.json())
            .then(data => {
                // console.log(data)
                document.querySelector("#messages").innerHTML = data;
            })
            .catch(error => {
                // console.error(error);
                clearInterval(intervalId);
                let errDiv = document.getElementById('refresh-err')
                errDiv.innerText = 'Error in getting data please refresh the page';
                errDiv.style.display = 'block';
            })
    }

</script>

<?php include_once __DIR__.'/../partials/footer.php'; ?>
