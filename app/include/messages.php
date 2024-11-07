<?php
if (isset($_SESSION['message'])) {
    // Check if $_SESSION['type'] is set, otherwise default to 'info' or any other default type
    $type = isset($_SESSION['type']) ? $_SESSION['type'] : 'info';

    // Initialize the style variable
    $style = "";

    // Assign the appropriate style based on the type
    if ($type == 'error') {
        $style = "
        width: 100%;
        margin: 5px auto;
        padding: 8px;
        border-radius: 5px;
        list-style: none;
        color: #884b4b;
        border: 1px solid #884b4b;
        background: #f5bcbc;";
    } else {
        $style = "
        width: 100%;
        margin: 5px auto;
        padding: 8px;
        border-radius: 5px;
        list-style: none;
        color: #3a6e3a;
        border: 1px solid #3a6e3a; /* Corrected 'soli' to 'solid' */
        background-color: #bcf5bc;";
    }
    ?>

    <div style="<?php echo $style; ?>" class="msg <?php echo $type; ?>">
        <li><?php echo $_SESSION['message']; ?></li>
    </div>

    <?php
    unset($_SESSION['message']);
    if (isset($_SESSION['type'])) {
        unset($_SESSION['type']);
    }
}
?>
