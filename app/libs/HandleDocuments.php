<?php

/**
 * Created by PhpStorm.
 * User: UltraKapes
 * Date: 10/16/2015
 * Time: 10:10 PM
 */
class HandleDocuments
{
    public static function loadDocuments($propertyID)
    {

        try {
            $db = Database::getInstance();
            $statement = $db->prepare("SELECT * FROM documents WHERE property_id = :property_id");
            $statement->bindParam(":property_id", $propertyID);
            $result = $statement->execute();


            if ($result != null) {
                $all_documents = array();
                while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                    $all_documents[$row->doc_id] = "
                  
                    
                  <div class='col-md-2'>
                    <div class='display_pdf'>
                  <a target='_blank' href='" .WEBDIR. $row->unique_id . "' >
                    <canvas id='" . $row->doc_id . "'/></a>
                    <div class='pdf_name'><a target='_blank' href='" .WEBDIR. $row->unique_id . "' >".$row->real_id."</a></div></div></div>";


                }
                $DBH = NULL;
                return $all_documents;

            }


            exit();

        } catch (Exception $e) {
            $db = NULL;
            echo 'Error: ' . $e->getMessage();
        }


    }


    public static function addDocument($propertyID, $unique, $real)
    {

        try {
            $db = Database::getInstance();
            $statement = $db->prepare("INSERT INTO documents (property_id, unique_id, real_id)
            VALUES (:property_id, :unique_id, :real_id)");
            $statement->bindParam(":property_id", $propertyID);
            $statement->bindParam(":unique_id", $unique);
            $statement->bindParam(":real_id", $real);
            $result = $statement->execute();


            if ($result) {
                return true;


            }
            $DBH = NULL;

            exit();

        } catch (Exception $e) {
            $db = NULL;
            echo 'Error: ' . $e->getMessage();
        }


    }


    public static function setPdfThumbs($pID){


        try {
            $db = Database::getInstance();
            $statement = $db->prepare("SELECT * FROM documents WHERE property_id = :property_id");
            $statement->bindParam(":property_id", $pID);
            $result = $statement->execute();
            if ($result != null) {
                $all_documents = array();
                while ($row = $statement->fetch(PDO::FETCH_OBJ)){
                    $all_documents[$row->doc_id] = $row->unique_id;

                }
                $DBH = NULL;
                return $all_documents;
            }
            else{
                return "no results";
            }

        } catch (Exception $e) {
            $db = NULL;
            return 'Error: ' . $e->getMessage();
        }
    }


    public static function loadInspections($propertyID)
    {

        try {
            $db = Database::getInstance();
            $statement = $db->prepare("SELECT * FROM inspections WHERE property_id = :property_id");
            $statement->bindParam(":property_id", $propertyID);
            $result = $statement->execute();


            if ($result != null) {
                $all_documents = array();
                while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                    $all_documents[$row->doc_id] = "
                    
                    
                    <div class='col-md-2'>
                    <div class='display_pdf'>
                  <a target='_blank' href='" .WEBDIR. $row->unique_id . "' >
                    <canvas id='" . $row->doc_id . "'/></a>
                    <div class='pdf_name'><a target='_blank' href='" .WEBDIR. $row->unique_id . "' >".$row->real_id."</a></div></div></div>";


                }
                $DBH = NULL;
                return $all_documents;

            }


            exit();

        } catch (Exception $e) {
            $db = NULL;
            echo 'Error: ' . $e->getMessage();
        }


    }

    public static function addInspection($propertyID, $unique, $real)
    {

        try {
            $db = Database::getInstance();
            $statement = $db->prepare("INSERT INTO inspections (property_id, unique_id, real_id)
            VALUES (:property_id, :unique_id, :real_id)");
            $statement->bindParam(":property_id", $propertyID);
            $statement->bindParam(":unique_id", $unique);
            $statement->bindParam(":real_id", $real);
            $result = $statement->execute();


            if ($result) {
                return true;


            }
            $DBH = NULL;

            exit();

        } catch (Exception $e) {
            $db = NULL;
            echo 'Error: ' . $e->getMessage();
        }


    }


    public static function setInspectionPdfThumbs($pID){


        try {
            $db = Database::getInstance();
            $statement = $db->prepare("SELECT * FROM inspections WHERE property_id = :property_id");
            $statement->bindParam(":property_id", $pID);
            $result = $statement->execute();
            if ($result != null) {
                $all_documents = array();
                while ($row = $statement->fetch(PDO::FETCH_OBJ)){
                    $all_documents[$row->doc_id] = $row->unique_id;

                }
                $DBH = NULL;
                return $all_documents;
            }
            else{
                return "no results";
            }

        } catch (Exception $e) {
            $db = NULL;
            return 'Error: ' . $e->getMessage();
        }
    }




}