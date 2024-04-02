<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../../connection/connection.php";
    if ($_POST['subject'] != -1) {
        $subject_choosed = $_POST['subject'];
        $get_tutor_sql = "SELECT users.name, users.id, subjects.subject, ROUND(AVG(ratings.rating), 2) AS average FROM users LEFT JOIN tutor ON tutor.user_id = users.id LEFT JOIN ratings ON ratings.tutor_id = tutor.tutor_id LEFT JOIN subjects ON subjects.tutor_id = tutor.tutor_id WHERE subjects.subject = '$subject_choosed'  GROUP BY users.name, users.id order by average desc ";
        $result = mysqli_query($con, $get_tutor_sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="tutor">
                    <img src="../../img/user.svg" alt="profile">
                    <form action="./findTutor.php" method="POST">
                        <input type="hidden" name="tutor_id" value="<?php echo $row['id']; ?>">
                        <span class="name">
                            <?php echo $row['name'] ?>
                        </span>
                        <span class="avg-rating">
                            Rating:
                            <?php echo $row['average'] > 0 ? $row['average'] : 0; ?>
                        </span>
                        <button type="submit" name="see-more">See More</button>
                    </form>
                </div>

                <?php
            }
        } else {
            echo "No tutor found";
        }

    }
}
?>