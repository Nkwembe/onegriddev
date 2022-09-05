<?php 
    class GithubIssue {

        public $id;
        public $title;
        public $body;
        public $status;
        public $priority;
        public $client;
        public $type;
        public $assignee;

        public function __construct() {

        }

        public function setId($id) {
            $this->id = $id;
        }
        public function getId() {
            return $this->id;
        }

        public function setTitle($title) {
            $this->title = $title;
        }
        public function getTitle() {
            return $this->title;
        }

        public function setBody($body) {
            $this->body = $body;
        }
        public function getBody() {
            return $this->body;
        }

        public function setStatus($status) {
            $this->status = $status;
        }
        public function getStatus() {
            return $this->status;
        }

        public function setPriority($priority) {
            $this->priority = $priority;
        }
        public function getPriority() {
            return $this->priority;
        }

        public function setClient($client) {
            $this->client = $client;
        }
        public function getClient() {
            return $this->client;
        }
        public function setAssignee($assignee) {
            $this->assignee = $assignee;
        }
        public function getAssignee() {
            return $this->assignee;
        }
    }
?>