<style>
    .username {
        text-align: center;
        font-size: 5rem;
    }


</style>
<!--if the login was successful , we will receive this message -->
<p class="username"><?php echo ".התחברת בהצלחה ! , מיד תועבר לדף הראשי" ?></p>


<!--sends back to the index page , after 2 seconds.-->
<?php header("refresh:2;url=index.php"); ?>