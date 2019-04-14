<!DOCTYPE html>
<!--
Copyright (C) 2019
   Alondra Dorantes <dorantesa2016@forsythtech.edu>
   Dana Caldwell <caldwelld2608@forsythtech.edu>
   Dung Duong <duongd1067@forsythtech.edu>
   Marshall Casey <caseym1325@students.forsythtech.edu>
   William West <westw2305@forsythtech.edu>
Created for the FTCC course CSC-289-900-2019SP.
This program can be freely copied and/or distributed.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>SM - Select Shift</title>
    </head>
    <body>
    <center>



        <?php
        include "db_connect.php";
        ?>
        <?php
        $id = 3;

        echo '<select>';
            echo '<option value="volvo">Volvo</option>';
            echo '<option value="saab">Saab</option>';
            echo '<option value="mercedes">Mercedes</option>';
            echo '<option value="audi">Audi</option>';
        echo '</select>';
        echo '<br>';

        $sql = 'SELECT * FROM Shift';
        $stmt = $connection->query($sql);

//        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//            echo $row['Description'] . '<br>';
//        }
        //while($row = $stmt->fetch(PDO::FETCH_OBJ)){
        while ($row = $stmt->fetch()) {
            //Shift_ID
            //Shift_Number
            //Start_DateTime
            //End_DateTime
            //Volunteer_Assigned
            //Volunteer_Needed
            //Males_Only
            //Minimum_Age
            echo '<input type="checkbox" name="shift_list" value="' . $row->Shift_ID . '"> ';
            //echo $row->Shift_Number . '#';
            echo $row->Start_DateTime . ' until ';
            echo $row->End_DateTime;
            //echo $row->Volunteer_Assigned . '#';
            //echo $row->Volunteer_Needed . '#';
            //echo $row->Males_Only . '#';
            //echo $row->Minimum_Age;
            echo '<br>';
        }
        ?>


        <ul>
            <li>Coffee</li>
            <li>Tea</li>
            <li>Milk</li>
        </ul>

        <!--
                #SELECT ALL BUTTON:
                        <script language="JavaScript">
                            function toggle(source) {
                                checkboxes = document.getElementsByName('foo');
                                for (var i = 0, n = checkboxes.length; i < n; i++) {
                                    checkboxes[i].checked = source.checked;
                                }
                            }
                        </script>
                
        
                <input type="checkbox" onClick="toggle(this)" /> Toggle All<br/>
        
                <input type="checkbox" name="foo" value="bar1"> Bar 1<br/>
                <input type="checkbox" name="foo" value="bar2"> Bar 2<br/>
                <input type="checkbox" name="foo" value="bar3"> Bar 3<br/>
                <input type="checkbox" name="foo" value="bar4"> Bar 4<br/>
        -->
        <br>
        <form action = "landing_page.php">
            <input type = "submit" name = "button_logout" value = "Save">
        </form>
        <form action = "landing_page.php">
            <input type = "submit" name = "button_cancel" value = "Cancel">
        </form>
    </center>
</body>
</html>