<?php
/*
 * Calculate and update the results of voting for the nominations
 * 
 * rounds = number of rounds
 * locations = number of locations
 * slots available: make sure we have one slot free for the ICCM Prep BO
 * 
 * in each workshop, calculate the number of votes of participants, and reset the field round_id, location_id and available
 * *
 */
namespace ICCM\BOF;
use \Firebase\JWT\JWT;
use \PDO;

class Result
{
    private $view;
    private $db;
    private $router;
 
    function __construct($view, $db, $router, $secrettoken) {
#        $this->view = $view;
        $this->db = $db;
#        $this->router = $router;
#        $this->secrettoken = $secrettoken;
    }
    
    /*
     * Clear database fieds for rounds and locations
     */
    function clear_results() {
            $sql = 'UPDATE workshop
                    SET votes = (SELECT SUM(participant)
                                 FROM workshop_participant
                                 WHERE workshop.id=workshop_participant.workshop_id),
                        round_id = NULL,
                        location_id = NULL,
                        available = NULL';
            $query=$this->db->prepare($sql);
            $param = array ($login, $password);
            try {
                $query->execute($param);
            } catch (PDOException $e){
                echo $e->getMessage();
                return False;
            }
            return True;            
    }
    
    function clear_results() {
        $sql = 'UPDATE workshop
                    SET votes = (SELECT SUM(participant)
                                 FROM workshop_participant
                                 WHERE workshop.id=workshop_participant.workshop_id),
                        round_id = NULL,
                        location_id = NULL,
                        available = NULL';
        $query=$this->db->prepare($sql);
        $param = array ($login, $password);
        try {
            $query->execute($param);
        } catch (PDOException $e){
            echo $e->getMessage();
            return False;
        }
        return True;
    }
    
    /*
     * set available field
     */
    function set_availables() {
        $sql = 'SELECT id
                FROM workshop
                WHERE published=1
                ORDER BY votes desc
                LIMIT 0, $rounds;';
        $query=$this->db->prepare($sql);
        $param = array ($login, $password);
        try {
            $query->execute($param);
        } catch (PDOException $e){
            echo $e->getMessage();
            return False;
        }
        return True;
    }
    
    
    
    public function calculate_results($request, $response, $args) {
        
        if ($this->clear_results()) {
            # next step
            print "Clear results succeeded";
        }
     
    }
}