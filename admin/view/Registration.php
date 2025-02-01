<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Registration</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Admin Registration</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="reg-form">
            <div class="container">
                <fieldset>
                    <legend>Admin Information</legend>
                    <table>
                        <tr>
                            <td>Username:</td>
                            <td><input type="text" name="username" required></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><input type="email" name="email" required></td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" name="password" required></td>
                        </tr>
                        <tr>
                            <td>Confirm Password:</td>
                            <td><input type="password" name="confirm_password" required></td>
                        </tr>
                        <tr>
                            <td>Phone Number:</td>
                            <td><input type="text" name="phone_number"></td>
                        </tr>
                        <tr>
                            <td>Role:</td>
                            <td>
                                <select name="role" required>
                                    <option value="">Select Role</option>
                                    <option value="super_admin">Super Admin</option>
                                    <option value="moderator">Moderator</option>
                                    <option value="content_manager">Content Manager</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Gender:</td>
                            <td>
                                <input type="radio" id="male" name="gender" value="male" required>
                                <label for="male">Male</label>
                                <input type="radio" id="female" name="gender" value="female" required>
                                <label for="female">Female</label>
                            </td>
                        </tr>
                        <tr>
                            <td>National ID Number:</td>
                            <td><input type="text" name="national_id"></td>
                        </tr>
                        <tr>
                            <td>Date of Birth:</td>
                            <td><input type="date" name="date_of_birth"></td>
                        </tr>
                        <tr>
                            <td>Joining Date:</td>
                            <td><input type="date" name="joining_date"></td>
                        </tr>
                        <tr>
                            <td>Working Time Start:</td>
                            <td><input type="time" name="working_time_start"></td>
                        </tr>
                        <tr>
                            <td>Working Time End:</td>
                            <td><input type="time" name="working_time_end"></td>
                        </tr>
                        <tr>
                            <td>Referenced By:</td>
                            <td><input type="text" name="referenced_by"></td>
                        </tr>
                    </table>
                </fieldset>

                <fieldset>
                    <legend>Account Preferences</legend>
                    <table>
                        <tr>
                            <td>Receive Notifications:</td>
                            <td>
                                <input type="checkbox" id="email_notifications" name="notifications[]" value="email">
                                <label for="email_notifications">Email</label>
                                <input type="checkbox" id="sms_notifications" name="notifications[]" value="sms">
                                <label for="sms_notifications">SMS</label>
                            </td>
                        </tr>
                        <tr>
                            <td>Preferred Language:</td>
                            <td>
                                <select name="language" required>
                                    <option value="">Select Language</option>
                                    <option value="english">English</option>
                                    <option value="bangla">Bangla</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Upload Profile Picture:</td>
                            <td><input type="file" name="profile_picture"></td>
                        </tr>
                    </table>
                </fieldset>

                <button type="submit" name="submit">Register</button>
                <button type="reset">Clear Form</button>
            </div>
        </div>
    </form>
    <!-- Include the external JavaScript file -->
    <script src="../js/form-validation.js"></script>
</body>
</html>
<?php
    include('../control/reg_control.php');
?>
