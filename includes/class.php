<?php
class Create_file {
    public string $name;
    public string $price;
    public string $file;
    function __construct($name, $price, $file)
    {
        $this->name = $name;
        $this->price = $price;
        $this->file = $file;
    }
     function Create_file() {
        $command = "touch " . $this->file;
        var_dump($command);
        // popen($command, "w");
        return var_dump($command);
    }
}
