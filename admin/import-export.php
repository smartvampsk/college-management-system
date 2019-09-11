<?php 
	class excelWork extends mysqli{
		private $state_csv = false;

		public function __construct(){
			parent::__construct("localhost", "root", "", "groupproject");
			if ($this->connect_error) {
				echo "Sorry!\nCouldn't connect to database". $this->connect_erroer;
			}
		}

		public function import($file){	
			$firstRow = false;
			$file = fopen($file, 'r');
			while ($row = fgetcsv($file)) {
				if (!$firstRow) {
					$firstRow = true;
				}
				else{
					$record = "'".implode("','", $row)."'";
					$stmt = "INSERT INTO admission(id, firstname, lastname, email, contactnumber, gender, schoolname, spercentage, highschool, hpercentage, bachelor, bpercentage, course) VALUES(".$record.")";
					if ($this->query($stmt)) {
						$this->state_csv = true;
					}
					else{
						$this->state_csv = false;
						echo $this->error;
					}
				}
			}
			if ($this->state_csv) {
				echo "Successfully imported";
			}
			else{
				echo "Failed to import";
			}
		}

		public function export(){
			$this->state_csv = false;
			$stmt = "SELECT e.id, e.firstname, e.lastname, e.email,e.contactnumber,e.gender,
			e.schoolname,e.spercentage,e.highschool,e.hpercentage,e.bachelor,e.bpercentage,e.course FROM admission as e";
			$run = $this->query($stmt);
			if ($run->num_rows>0) {
				$fn = "csv_".uniqid().".csv";
				$file = fopen("files/".$fn, "w");
				while ($row = $run->fetch_array(MYSQLI_NUM)) {
					if (fputcsv($file, $row)) {
						$this->state_csv = true;
					}
					else{
						$this->state_csv = false;
					}
				}
				if ($this->state_csv) {
					echo "Successfully Exported";
				}
				else{
					echo "Failed to Export";
				}
				fclose($file);
			}
			else{
				echo "No data found";
			}
		}
	}
?>