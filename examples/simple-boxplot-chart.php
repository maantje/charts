<?php

require '../vendor/autoload.php';

use Maantje\Charts\Boxplot\Boxplot;
use Maantje\Charts\Boxplot\Boxplots;
use Maantje\Charts\Chart;

$chart = new Chart(
    series: [
        new Boxplots(
            boxplots: [
                new Boxplot(
                    name: 'January',
                    values: [12, 30, 45, 60, 88],
                ),
                new Boxplot(
                    name: 'February',
                    values: [20, 35, 50, 70, 95, 130, 4],
                ),
                new Boxplot(
                    name: 'March',
                    values: [8, 22, 38, 55, 76, 110],
                    fillColor: '#2ecc71',
                ),
            ],
        ),
    ],
);

echo $chart->render();
