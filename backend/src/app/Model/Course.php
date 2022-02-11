<?php

namespace app\Model;

class Course{

    //Attributes
    private int $id;
    private string $name;
    private string $description;
    private string $backgroundImage;
    private string $redirectionURL;

    public function __construct(
        string $name = "",
        string $description = "",
        string $redirectionURL = "",
        string $backgroundImage = "",
        int $id = 0
    )
    {
        $this->setName($name);
        $this->setDescription($description);
        $this->setRedirectionURL($redirectionURL);
        $this->setBackgroundImage($backgroundImage);
        $this->setId($id);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getBackgroundImage(): string
    {
        return $this->backgroundImage;
    }

    /**
     * @param string $backgroundImage
     */
    public function setBackgroundImage(string $backgroundImage): void
    {
        $this->backgroundImage = $backgroundImage;
    }

    /**
     * @return string
     */
    public function getRedirectionURL(): string
    {
        return $this->redirectionURL;
    }

    /**
     * @param string $redirectionURL
     */
    public function setRedirectionURL(string $redirectionURL): void
    {
        $this->redirectionURL = $redirectionURL;
    }

    public static function moveBackgroundImage(string $filename): ?string
    {
        $file = $_FILES[$filename];
        if($file["error"]){
            throw new Exception("Erro no envio do arquivo. Erro: ".$file["error"]);
        }
        $dirUpload = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."/public/images/uploads";
        if(!is_dir($dirUpload)){
            mkdir($dirUpload);
        }
        if(move_uploaded_file($file["tmp_name"], $dirUpload.DIRECTORY_SEPARATOR.$file["name"])){
            return 'http://'.$_SERVER['HTTP_HOST']."/public/images/uploads/".$file["name"];
        }else{
            throw new \Exception("Erro no upload");

        }
    }


}