<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Placement Portal</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
    #barChart{
        padding:3.5rem;
    }
    </style>
<body>
 <section class="charts">
<div>
<canvas id="barChart"></canvas>
</div>
</section>
<script src="Analysis.js"></script>
</body>
</html>    
