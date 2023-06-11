<?php

class ExerciseExternalFetcher {
    private $base_url = "https://timeapi.io/api/Time/current/zone?timeZone=Europe/Amsterdam";

    public function getExerciseByDate($date) {
        $url = $this->base_url . "&date=" . $date;

        // Perform the API request to retrieve exercise data for the given date
        $data = $this->makeRequest($url);

        // Process the retrieved data as needed
        // ...

        return $data;
    }

    public function getAllExercises() {
        $url = $this->base_url;

        // Perform the API request to retrieve all exercise data
        $data = $this->makeRequest($url);

        // Process the retrieved data as needed
        // ...

        return $data;
    }

    private function makeRequest($url) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        // Parse the response data as needed
        $data = json_decode($response, true);

        return $data;
    }
}


    /*public function getTime($date, $time)
    {
        $url = $this->base_url . "{$date}:{$time}";

        $data = file_get_contents($url);

        return json_decode($data, true);
    }*/

   /* public function getEndTime($hour, $minute)
    {
        $url = $this->base_url . "{$hour}:{$minute}";

        $data = file_get_contents($url);

        return json_decode($data, true);
    }*/




