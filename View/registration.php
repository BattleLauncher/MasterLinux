<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Your Startup</title>
</head>
<body>
    <section class="registration-form">
        <div class="container">
            <fieldset>
                <legend><h1>Register Your Startup</h1></legend>
                <p>Fill in your business details to join our platform and promote your startup.</p>

                <form action="/submit-registration" method="POST">
                    <!-- Business Information Section -->
                    <fieldset>
                        <legend>Business Information</legend>
                        <table>
                            <tr>
                                <td><label for="business-name">Business Name:</label></td>
                                <td><input type="text" id="business-name" name="business_name" required></td>
                            </tr>
                            <tr>
                                <td><label for="business-type">Business Type:</label></td>
                                <td>
                                    <select id="business-type" name="business_type" required>
                                        <option value="ecommerce">E-commerce</option>
                                        <option value="manufacturer">Manufacturer</option>
                                        <option value="service">Service Provider</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="location">Business Location:</label></td>
                                <td><input type="text" id="location" name="location" required></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <!-- Social Media Links -->
                    <fieldset>
                        <legend>Social Media</legend>
                        <table>
                            <tr>
                                <td><label fohob nar="social-link">Social Media Link:</label></td>
                                <td><input type="url" id="social-link" name="social_link"></td>
                            </tr>
                        </table>
                    </fieldset>

                    <button type="submit">Register Business</button>
                </form>

                <p>Already registered? <a href="signin.html">Sign In</a></p>
            </fieldset>
        </div>
    </section>
</body>
</html>
