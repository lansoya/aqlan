<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            text-align: center;
            margin: 0;
            background-color: #f0f0f0; /* Set a background color for the body */
        }

        /* Style for the green box */
        .result-box {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: yellowgreen;
            width: 50%; /* Adjust as needed */
            height: 50%; /* Adjust as needed */
            margin: auto;
            margin-top: 50px; /* Add margin to center the box vertically */
            border-radius: 10px; /* Add border-radius for rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
        }

        /* Style for the input form results with a white background */
        .input-results {
            background-color: white;
            padding: 20px; /* Add padding for spacing inside the box */
            border-radius: 10px; /* Add border-radius for rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
            margin-top: 30px; /* Add margin for spacing between the boxes */
            width: 50%; /* Adjust as needed */
            margin: auto; /* Center the box horizontally */
        }

        /* Style for the footer */
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .error {
            color: #FF0000;
        }
    </style>
</head>
<body>
    <?php
    $nameErr = $weightErr = $heightErr = $ageErr = $genderErr = "";
    $name = $weight = $height = $age = $gender = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = valid_input($_POST["name"]);
    $weight = valid_input($_POST["weight"]);
    $height = valid_input($_POST["height"]);
    $age = valid_input($_POST["age"]);
    $gender = valid_input($_POST["gender"]);

    if (empty($name)) {
        $nameErr = "Name is required";
    }

    if (empty($weight)) {
        $weightErr = "Weight is required";
    } elseif (!is_numeric($weight)) {
        $weightErr = "Weight must be a number";
    }

    if (empty($height)) {
        $heightErr = "Height is required";
    } elseif (!is_numeric($height)) {
        $heightErr = "Height must be a number";
    }

    if (empty($age)) {
        $ageErr = "Age is required";
    } elseif (!is_numeric($age)) {
        $ageErr = "Age must be a number";
    }

    if (empty($gender)) {
        $genderErr = "Gender is required";
    }
}

function valid_input($data_input) {
    $data_input = trim($data_input);
    $data_input = stripslashes($data_input);
    $data_input = htmlspecialchars($data_input);
    return $data_input;
}

function calculate_bmi($weight, $height) {
    // Check if the input values are numeric before performing the calculation
    if (is_numeric($weight) && is_numeric($height) && $height > 0) {
        // Calculate BMI using the formula: BMI = weight / height^2
        $bmi = $weight / ($height ** 2);
        return $bmi;
    } else {
        return "Invalid input for BMI calculation";
    }
}

function calculate_lbm($bmi, $age, $gender) {
    // Calculate Lean Body Mass (LBM) based on gender-specific formulas
    if (strtolower($gender) == 'male') {
        $lbm = (1.20 * $bmi) + (0.23 * $age - 16.2);
    } elseif (strtolower($gender) == 'female') {
        $lbm = (1.20 * $bmi) + (0.23 * $age - 5.4);
    } else {
        throw new Exception("Please choose your gender");
    }

    return $lbm;
}

// Determine the category of LBM from the information in the LBM Category table
function LBMCategory($lbmPercentageMale, $lbmPercentageFemale, $gender) {
    if (strtolower($gender) == 'male') {
        if ($lbmPercentageMale >= 2 && $lbmPercentageMale <= 5) {
            return "Essential Fat";
        } elseif ($lbmPercentageMale >= 6 && $lbmPercentageMale <= 13) {
            return "Athletes";
        } elseif ($lbmPercentageMale >= 14 && $lbmPercentageMale <= 17) {
            return "Fitness";
        } elseif ($lbmPercentageMale >= 18 && $lbmPercentageMale <= 25) {
            return "Average";
        } elseif ($lbmPercentageMale > 25) {
            return "Obese";
        }
    } elseif (strtolower($gender) == 'female') {
        if ($lbmPercentageFemale >= 10 && $lbmPercentageFemale <= 13) {
            return "Essential Fat";
        } elseif ($lbmPercentageFemale >= 14 && $lbmPercentageFemale <= 20) {
            return "Athletes";
        } elseif ($lbmPercentageFemale >= 21 && $lbmPercentageFemale <= 24) {
            return "Fitness";
        } elseif ($lbmPercentageFemale >= 25 && $lbmPercentageFemale <= 31) {
            return "Average";
        } elseif ($lbmPercentageFemale > 32) {
            return "Obese";
        }
    }
}
    if ($_SERVER["REQUEST_METHOD"] == "POST" && (empty($name) || empty($weight) || empty($height) || empty($age) || empty($gender))) {
        echo "<p class='error'>Users are not allowed to leave item No.1 – No.5 empty</p>";
    } else {
        // Calculate BMI
        $bmi = calculate_bmi($weight, $height);

        // Calculate Lean Body Mass (LBM)
        $lbm = calculate_lbm($bmi, $age, $gender);

        // Separate male and female percentages for LBM
        $lbmPercentageMale = ($lbm / $weight) * 100;
        $lbmPercentageFemale = ($lbm / $weight) * 100;


        // Determine LBM category
        $lbm_category = LBMCategory($lbmPercentageMale, $lbmPercentageFemale, $gender);

        // Display results in the green box
        echo "<div class='result-box'>";
        echo "<div class='input-results'>";
        echo "<h2>Results:</h2>";
        echo "<p>Name: $name</p>";
        echo "<p>Weight: $weight kg</p>";
        echo "<p>Height: $height m</p>";
        echo "<p>Gender: $gender</p>";
        echo "<p>Age: $age</p>";
        echo "<p>BMI: " . (is_numeric($bmi) ? round($bmi, 2) : $bmi) . "</p>";
        echo "<p>LBM Category: " . $lbm_category . "</p>";
        echo "</div>";
        echo "</div>";
    }
    ?>

    <!-- The footer -->
        <footer>
            <p>&copy; Univ. Kuala Lumpur BMI and LBM Calculator</p>
        </footer>

</body>
</html>
