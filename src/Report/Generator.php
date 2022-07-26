<?php

namespace AMeheina\Querylyser\Report;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class Generator
{
    public function generate($results): string
    {
        $reportFile = 'query_report.html';

        $reportContent = $this->getContent($results);

        Storage::put($reportFile, $reportContent);

        return storage_path().'/'.$reportFile;
    }

    private function getContent($results): string
    {
        return $this->prepareHead().
            $this->prepareStatistics($results).
            $this->prepareCards($results).
            $this->prepareFooter();
    }

    private function prepareHead(): string
    {
        return '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
            <title>Querylyser Report</title>
            <!-- Custom fonts for this template-->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" rel="stylesheet" type="text/css">
            <link
                    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
                    rel="stylesheet">

            <!-- Custom styles for this template-->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css" rel="stylesheet">
        </head>
        <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Results</h1>
                    </div>
        ';
    }
    private function prepareStatistics($results): string
    {
        $scannedQueriesCount = $results->count();
        $passedQueriesCount = $results->count();
        $passedQueriesPercentatge = round($passedQueriesCount * 100 / $scannedQueriesCount);

        return '
                        <div class="row">

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Processed Queries</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">'.$scannedQueriesCount.'</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-500"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Passed Queries
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">'.$passedQueriesCount.'</div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm mr-2">
                                                    <div class="progress-bar bg-info" role="progressbar"
                                                         style="width: '.$passedQueriesPercentatge.'%" aria-valuenow="50" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-check-circle fa-2x text-gray-500"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



            </div>
            <!-- /.container-fluid -->
        ';
    }

    private function prepareCards($results): string
    {

        $cards = $results->map(function ($result){
            [$query , $checkresults] = $result;


            ;
            $card= '<div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                               role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">'.$query->statement_with_bindings.'</h6>
                            </a>
                            <div class="collapse show" id="collapseCardExample">
                                <div class="card-body"><ul>';

            $card.= '<li>Backtrace : '. $query->backtrace.'</li>';
            $card.= '<li>Execution Time (sec): '. ($query->time / 1000).'</li>';
            $card.= '<li>Checks :</li><ol>';
            foreach ($checkresults as $checkresult) {
                $card.= '<li>'.last(explode('\\', $checkresult::class)) .' => '.
                    ($checkresult->passes? '<label style="color:green;">Passes</label>' : '<label style="color:red;">Failed</label>' ).'</li>';
            }
            $card.= '
</ol>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            return $card;
        });

        return $cards->implode('');
    }

    private function prepareFooter(): string
    {
        return '
        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Bootstrap core JavaScript-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/js/sb-admin-2.min.js"></script>
        </body>
        </html>';
    }
}
