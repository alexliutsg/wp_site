<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/scripts/jquery.dataTables.css">
</head>
<body>

        <?php
		global $wpdb;
                //$columns = $wpdb->get_results( 'SHOW COLUMNS FROM schools ', OBJECT );
		$school = $wpdb->get_results( '
            SELECT primary_name, alternative_name, address, contact_number, email, fax_number, contact_person, title FROM schools',OBJECT);

        ?>

        <table id="school" class="display" cellspacing="0" width="100%">
            <?php
            if (count($school) > 0) {
                echo "<thead><tr><th>School Primary Name</th><th>Alternative Name</th><th>Address</th><th>Contact Number</th><th>Email</th><th>Fax</th><th>Contact Person</th><th>Title</th></tr></thead>";
                echo "<tbody>";
                foreach ( $school as $row )
                {
                    echo "<tr><td>".$row->primary_name."</td><td>".$row->alternative_name."</td><td>".$row->address."</td><td>".$row->contact_number."</td><td>".$row->email."</td><td>".$row->fax_number."</td><td>".$row->contact_person."</td><td>".$row->title."</td></tr>";
                }
                echo "</tbody>";
            } else {
                echo "There is no school registered.";
            }
            ?>
        </table>

        <script type="text/javascript" charset="utf8" src="/scripts/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" charset="utf8" src="/scripts/jquery.dataTables.min.js"></script>
        <script>
            $(function(){
                $("#school").dataTable();
            })
        </script>
</body>
</html>
