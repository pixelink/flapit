<?php
/**
 * Created by PhpStorm.
 * User: briezler
 * Date: 03.10.18
 * Time: 14:48
 */

namespace Pixelink\Flapit;


class flapItCounter
{
    public $counterFile = "";
    public $groupId = "";
    public $token = "";
    public $leadIcon = "";


    public function __construct($groupId, $token, $leadIcon, $counterFile="counter.txt")
    {
        $this->groupId = $groupId;
        $this->token = $token;
        $this->leadIcon = $leadIcon;
        $this->counterFile = $counterFile;

        $this->updateCounter();
        $this->sendToFlapit();
    }

    /**
     * returns counter value
     */
    public function getCounter()
    {
        return file_get_contents($this->counterFile);
    }

    /**
     * update counter value
     */
    public function updateCounter()
    {
        $counter = $this->getCounter();
        $counter++;

        $this->writeCounter($counter);
    }

    /**
     * update counter file
     */
    public function writeCounter($newCounterValue)
    {
        $handle = fopen($this->counterFile, "w+");
        fwrite($handle, $newCounterValue);
        fclose($handle);
    }

    /**
     * Send request to flapit.com api
     */

    public function sendToFlapit()
    {
        $flapItMsg = $this->leadIcon . $this->getCounter();

        $data = array(
            "group_id" => $this->groupId,
            "token" => $this->token,
            "message" => $flapItMsg
        );

        $data_string = json_encode($data);

        $ch = curl_init('https://www.flapit.com/control/group');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );

        $result = curl_exec($ch);
    }
}