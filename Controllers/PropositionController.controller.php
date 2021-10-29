<?php

require_once 'models/PropositionManager.class.php';

class PropositionController {
    private $propositionManager;

    public function __construct(){
        $this->diffuseurManager = new PropositionManager;
        $this->diffuseurManager->loadingPropositions();
    }
}