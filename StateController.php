<?php
defined("ACCESS_SUCCESS") or header("location: ../error-403");
class StateController
{
    private $model;

    public function __construct()
    {
        Load::model("DbStateModel");
        $this->model = new DbStateModel();
    }

    public function index()
    {
        foreach ($this->model->getStates() as $state) {
            var_dump($state);
            echo "<br>";
        }
    }

    public function page($noPage)
    {
        $config = array();
        $config["paginationData"] = $this->model->getStates();
        $config["currentPage"] = $noPage;
        $config["dataRange"] = 10;
        $config["pagesGroupSize"] = 7;

        Pagination::setConfig($config);

        $data["pagination"] = Pagination::getPaginationResources();
        $data["states"] = Pagination::getGroupData();

        if ($data["pagination"]->badRequest) {
            ErrorPage::show404();
        }

        Load::view("state/state", "php", $data);
    }
}
