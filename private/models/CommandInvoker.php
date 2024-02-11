
<?php
class CommandInvoker {
    private $command;

    public function setCommand(Command $command) {
        $this->command = $command;
    }

    public function executeCommand() {
        return $this->command->execute();
    }
}