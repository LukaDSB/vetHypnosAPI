<?php
class Contato{
    private ? int $id;
    private ? string $telefone;
    private ? string $celular;
    private ? string $email;
    private ? string $facebook;
    private ? string $twitter;
    private ? string $instagram;
    private ? string $linkedin;
    private ? string $lattes;
    private ? string $site;




public function __construct(?int $id, ?string $telefone, ?string $celular, ?string $email, ?string $facebook, ?string $twitter, ?string $instagram, ?string $linkedin, ?string $lattes, ?string $site){ 
    $this->id = $id;
    $this->telefone = $telefone;
    $this->celular = $celular;
    $this->email = $email;
    $this->facebook = $facebook;
    $this->twitter = $twitter;
    $this->instagram = $instagram;
    $this->linkedin = $linkedin;
    $this->lattes = $lattes;
    $this->site = $site;
}

public function toArray(): array {
    return [
        'id' => $this->id,
        'telefone' => $this->telefone,
        'celular'=> $this->celular,
        'email'=> $this->email,
        'facebook'=> $this->facebook,
        'twitter'=> $this->twitter,
        'instagram'=> $this->instagram,
        'linkedin'=> $this->linkedin,
        'lattes'=> $this->lattes,
        'site'=> $this->site
    ];
}

public static function fromArray(array $data): self {
    return new self(
        isset($data['id']) ? (int) $data['id'] : null,
        $data['telefone'],
        $data['celular'],
        $data['email'],
        $data['facebook'],
        $data['twitter'],
        $data['instagram'],
        $data['linkedin'],
        $data['lattes'],
        $data['site']
    );
}

public function getId() { return $this->id; }
public function setId($id) { $this->id = $id; }
public function getTelefone(){return $this->telefone;}
public function setTelefone($telefone){$this->telefone = $telefone;}
public function getCelular(){return $this->celular;}
public function setCelular($celular){$this->celular = $celular;}
public function getEmail(){return $this->email;}
public function setEmail($email){$this->email = $email;}
public function getFacebook(){return $this->facebook;}
public function setFacebook($facebook){$this->facebook = $facebook;}
public function getTwitter(){return $this->twitter;}
public function setTwitter($twitter){$this->twitter = $twitter;}
public function getInstagram(){return $this->instagram;}
public function setInstagram($instagram){$this->instagram = $instagram;}
public function getLinkedin(){return $this->linkedin;}
public function setLinkedin($linkedin){$this->linkedin = $linkedin;}
public function getLattes(){return $this->lattes;}
public function setLattes($lattes){$this->lattes = $lattes;}
public function getSite(){return $this->site;}
public function setSite($site){$this->site = $site;}




}

?>