#Cooldown! This should work for stuff that is not commands, I think.
    public function onCommand(CommandSender $sender, Command $cmd, $lable, array $args) {
        $dataFilezz = $this->getDataFolder() . strtolower($sender->getName());
               $name = $sender->getName();
                  switch ($cmd->getName()) {
                     case "cmd":
                        $cmdname = "cmd"
                       if($sender instanceof Player){
                           if(is_file($dataFilezz)) {
                                $data = yaml_parse_file($dataFilezz);
                                $lastTime = $data["last-execute-command"][$cmdname];
                           } else {
                                 $lastTime = 0;
                                 $cooldown = 1200; //Time In Seconds
                           } if(time() - $lastTime < $cooldown) {
                                 $timeLeft = time() - $lastTime;
                                 $cooldownmins = $cooldown/60;
                                 $sender->sendMessage("Please wait for your cooldown to expire! You last used the command " . $timeLeft . " seconds ago, but you must wait" . $cooldown . "seconds (" . $cooldownmins . " minutes) until you may use it again!");
                                 return true;
                           }
                           $data["last-execute-command"][$cmdname]= time();
                           yaml_emit_file($dataFilezz, $data);
                           //Command data
                           return true;
                     }
