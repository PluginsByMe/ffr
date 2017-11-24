  public function test(){
    $id = $this->getRandId();
    $ui = new \Plexus\UI\CustomUI($id);
    $ui->data = ['type' => 'custom_form', 'title' => 'test ui', 
      'content' => [   
        ['type' => 'toggle', 'text' => 'toggle'],
        ['type' => 'slider', 'text' => 'slider', 'min' => 0 , 'max' => 10],
        ['type' => 'step_slider', 'text' => 'step slider', 'steps' => array('1', '2', '3', '4', '5')],
        ['type' => 'input', 'text' => 'imput', 'placeholder' => 'placeholder text', 'default' => null],
        ["type" => 'dropdown', 'text' => 'dropdown', 'options' => array('1', '2', '3'), 'default' => null]
      ]];
    $this->getPlugin()->ui['test'] = $ui;
  } 