<?php
    
    // require_once('models/GithubIssue.php');
    
    // $GithubIssue = new GithubIssue();

    class GithubIssueMapper {

        public $model;
        // public $url = "https://api.github.com/repos/nkwembe/onegriddev/issues";
        public $url = "https://api.github.com/repos/1-grid/GitIntegration/issues";
        public $repository = "1-grid";
        public $token;
        public $data;

        public function __construct() {
           if (isset($_SESSION['access_token'])) {
            //set token only when user is authenticated
            //$this->token = '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';
            $this->token = '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';
           }
        }

        public function setRepository($repository) {
            $this->repository = $repository;
        }

        public function setToken($token) {
            if ($token !== $this->token) {
                $this->token = $token;
            }
        }

        public function getToken() {
            return $this->token;
        }

        public function getHeaders() {
            return [
                "User-Agent: 1-Grid Dev Assessment",
                "Accept: application/vnd.github+json",
                "Authorization: Bearer " . $this->getToken()
            ];
        }

        private function setUrl($url) {
            //a custom url can be set, mainly while testing; but we haven't used this
            if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
                $url_parts = parse_url($url);
                if ($url_parts['scheme'] . '://'. $url_parts['host'] === 'https://api.github.com') {
                    $this->url = $url;
                }
            }
        }

        public function getUrl() {
            return $this->url;
        }

        public function setPostData($data = array()) {
            $this->data = $data;
        }

        public function getPostData() {
            return $this->data;
        }

        public function getGithubIssues() {
            $ch = curl_init($this->getUrl());
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaders());
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $res = curl_exec($ch);
            $res_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            return ['response_code' => $res_code, 'response' => $res ];
        }

        public function createGithubIssue() {
            if (is_array($this->getPostData()) && count($this->getPostData())) {
                //check if at least title exists and has value 
                if (array_key_exists('title', $this->getPostData()) && !empty($this->getPostData()['title'])) {
                    $json_data = json_encode($this->getPostData());
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $this->getUrl());
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaders());
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $res = curl_exec($ch);
                    $res_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);
                    return ['response_code' => $res_code, 'response' => $res ];
                }
            }
            return null;
        }
    }
?>