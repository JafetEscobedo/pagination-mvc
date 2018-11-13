<?php
defined("ACCESS_SUCCESS") or header("location: ../error-403");
final class Pagination
{
    private static $paginationData;
    private static $currentPage;
    private static $dataRange;
    private static $pagesGroupSize;

    public static function setConfig($config)
    {
        self::$paginationData = $config["paginationData"];
        self::$currentPage = $config["currentPage"];
        self::$dataRange = $config["dataRange"];
        self::$pagesGroupSize = $config["pagesGroupSize"];
    }

    public static function getGroupData()
    {
        /* validar formato de $currentPage */
        if (ctype_digit(self::$currentPage)) {
            /* inicio de la selección */
            $start = (self::$currentPage - 1) * self::$dataRange;
            return array_slice(self::$paginationData, $start, self::$dataRange);
        } else {
            return null;
        }
    }

    public static function getPaginationResources()
    {
        $totalRows = count(self::$paginationData);
        $totalPages = ceil($totalRows / self::$dataRange);
        $totalPagesGroups = ceil($totalPages / self::$pagesGroupSize);
        $currentPagesGroup = 0;
        $limitPagesGroup = 0;
        $badRequest = FALSE;

        /* calcular el grupo de pagina en el que se está con la página dada */
        do {
            /* la pagina se encuentra en un grupo de paginas superior al actual */
            $limitPagesGroup += self::$pagesGroupSize;
            $currentPagesGroup++;
        } while (self::$currentPage > $limitPagesGroup);

        $lastPage = $currentPagesGroup * self::$pagesGroupSize;
        $firstPage = ($lastPage - self::$pagesGroupSize) + 1;

        /* verificar que la pagina solicitada sea */
        if (self::$currentPage > $totalPages ||
                self::$currentPage <= 0 ||
                !ctype_digit(self::$currentPage)) {
            $badRequest = TRUE;
        }

        $pagination = array();
        $pagination["badRequest"] = $badRequest;
        $pagination["previousPage"] = ($badRequest) ? null : self::$currentPage - 1;
        $pagination["nextPage"] = ($badRequest) ? null : self::$currentPage + 1;
        $pagination["currentPage"] = self::$currentPage;
        $pagination["totalPages"] = $totalPages;
        $pagination["firstPage"] = $firstPage;
        $pagination["lastPage"] = $lastPage;
        $pagination["currentPagesGroup"] = $currentPagesGroup;
        $pagination["totalPagesGroups"] = $totalPagesGroups;
        return (object) $pagination;
    }
}
?>

