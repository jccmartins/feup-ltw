<?php function draw_homeBackground($headTitle)
{
    /**
     * Draws home background image and styles topNav
     */ ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title><?php echo $headTitle; ?></title>
        <link href="../css/home.css" rel="stylesheet">
        <link href="../css/topNav.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    </html>

<?php }

function draw_whiteBackground($headTitle)
{
    /**
     * Draws white background image and styles topNav
     */ ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title><?php echo $headTitle; ?></title>
        <link href="../css/whiteBackground.css" rel="stylesheet">
        <link href="../css/whiteTopNav.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    </html>

<?php }

function draw_hostHomeBackground()
{
    /**
     * Draws white background image and styles topNav
     */ ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Host your place</title>
        <link href="../css/hostBackground.css" rel="stylesheet">
        <link href="../css/topNav.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    </html>

<?php }
