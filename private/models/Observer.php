
<?php 

interface Observer {
    public function sendNotification(string $message,string $title);
}
