<?php 
    require_once 'Conn.php';

    class projetos extends Conn {

        private $idProjeto;
        private $nomeProjeto;
        private $prioridade;
        private $linkProjeto;
        private $imgDesktop;
        private $imgMobile;

        public function getIdProjeto(){
            return $this->idProjeto;
        }

        public function setIdProjeto($idProjeto){
            $this->idProjeto = $idProjeto;
        }

        public function getNomeProjeto(){
            return $this->nomeProjeto;
        }

        public function setNomeProjeto($nomeProjeto){
            $this->nomeProjeto = $nomeProjeto;
        }

        public function getPrioridade(){
            return $this->prioridade;
        }

        public function setPrioridade($prioridade){
            $this->prioridade = $prioridade;
        }

        public function getLinkProjeto(){
            return $this->linkProjeto;
        }

        public function setLinkProjeto($linkProjeto){
            $this->linkProjeto = $linkProjeto;
        }

        public function getImgDesktop(){
            return $this->imgDesktop;
        }

        public function setImgDesktop($imgDesktop){
            $this->imgDesktop = $imgDesktop;
        }

        public function getImgMobile(){
            return $this->imgMobile;
        }

        public function setImgMobile($imgMobile){
            $this->imgMobile = $imgMobile;
        }

        public function getProjects(){
            $sql = new Conn();

            $results = $sql->select("SELECT * FROM projetos ORDER BY prioridade DESC, dataAtualizacao DESC", []);
    
            if(count($results) > 0){
                return $results;
            } else {
                header('Location: ../home.php?login=error');
                throw new Exception("Login ou senha inválidos.", 1550);
            }
        }

        public function setProject($nomeProjeto, $prioridade, $linkProjeto, $imgDesktop, $imgMobile){

            $this->setNomeProjeto($nomeProjeto);
            $this->setPrioridade($prioridade);
            $this->setLinkProjeto($linkProjeto);
            $this->setImgDesktop($imgDesktop);
            $this->setImgMobile($imgMobile);

            $sql = new Conn();

            $result = $sql->insert("INSERT INTO projetos (nomeProjeto, prioridade, imgDesktop, imgMobile, linkProjeto) VALUES (:NOMEPROJETO, :PRIORIDADE, :IMGDESKTOP, :IMGMOBILE, :LINKPROJETO)", [
                ":NOMEPROJETO" => $this->getNomeProjeto(),
                ":PRIORIDADE" => $this->getPrioridade(),
                ":IMGDESKTOP" => $this->getImgDesktop(),
                ":IMGMOBILE" => $this->getImgMobile(),
                ":LINKPROJETO" => $this->getLinkProjeto(),
            ]);

            if($result > 0){
                header('Location: ../home.php?projeto=success');
            } else {
                header('Location: ../home.php?projeto=error');
            }
        }

        public function delProject($idProject){

            $this->setIdProjeto($idProject);

            $sql = new Conn();

            $result = $sql->delete("DELETE FROM projetos WHERE id = :IDPROJETO", [
                ":IDPROJETO" => $this->getIdProjeto()
            ]);

            if($result > 0){
                header('Location: ../home.php?delete=success');
            } else {
                header('Location: ../home.php?delete=error');
            }
        }
    }
?>