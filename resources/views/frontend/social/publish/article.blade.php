@extends('frontend.layouts.app')

@section('title', __('Publish article'))

@push('before-styles')
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        /* LAYOUT */

        #container {
            /* max-width: 500px; */
            width: 100%;
            margin: 100px auto;
            padding: 40px;
            background: #FFFFF0;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);
            border-radius: 5px;
        }


        /* PROGRESS BAR */

        #progressbarContainer {
            display: grid;
        }

        #emptyProgressbar {
            height: 5px;
            width: 100%;
            margin: 22.5px 0;
            background: rgb(100, 100, 100);
        }

        #completedProgress {
            margin-top: -27.5px;
            width: 0;
            height: 5px;
            background: #f85b1c;
            transition: 0.5s;
        }

        #progressbarContainer ul {
            width: 100%;
            display: flex;
            list-style: none;
            justify-content: space-between;
            margin-top: -50px;
        }

        #progressbarContainer ul li {
            width: 50px;
            height: 50px;
            font-size: 25px;
            font-weight: bold;
            line-height: 40px;
            color: rgb(100, 100, 100);
            text-align: center;
            border: 5px solid rgb(100, 100, 100);
            border-radius: 100%;
            background: #FFFFF0;
            transition: 0.5s;
        }

        .completedStep {
            border-color:#f85b1c !important;
            background-color: #f85b1c !important;
            color: white !important;
        }

        .activeStep {
            border-color: #f85b1c !important;
            color: #f85b1c !important;
        }


        /* PAGES */
        .stepPage {
            display: none;
            height: 150px;
            padding: 50px;
        }


        /* NEXT/PREVIOUS BUTTONS */

        nav {
            height: 50px;
        }

        button {
            width: 50px;
            height: 50px;
            font-size: 40px;
            line-height: 40px;
            color: rgb(100, 100, 100);
            text-align: center;
            border: 5px solid rgb(100, 100, 100);
            border-radius: 100%;
            background: #FFFFF0;
            transition: 0.3s;
            cursor: pointer;
            outline: none;
        }

        #next {
            float: right;
        }

        #prev {
            visibility: hidden;
        }

        button:hover {
            color: #f85b1c;
            border-color: #f85b1c;
        }
    </style>
@endpush

@push('before-scripts')
    <script>
        var currentStep = 1;
        var stepsNum = 4;

        // show default page
        document.getElementById("stepPage" + currentStep).style.display = "block";
        document.getElementById("stepLable" + currentStep).classList.add("activeStep");

        // change step from current active step to a new active (next or previous)
        function changeStep(active, newActive) {

            // get active step page and hide it
            document.getElementById("stepPage" + active).style.display = "none";

            // show new step page
            document.getElementById("stepPage" + newActive).style.display = "block";

            // get active step lable and remove class active
            var activeStepL = document.getElementsByClassName("activeStep")[0];
            activeStepL.classList.remove("activeStep");

            // get new active step lable, add class active
            var newActiveStepL = document.getElementById("stepLable" + newActive);
            newActiveStepL.classList.add("activeStep");

            // update progress bar
            var p = (100 / (stepsNum - 1)) * (newActive - 1);
            document.getElementById("completedProgress").style.width = p + "%";

            // if user moves to next step, add class completed to previous
            if(active < newActive) {
                activeStepL.classList.add("completedStep");

                // replace number with checkmark
                activeStepL.innerHTML = "<i style='font-size:40px' class='bi bi-check-lg'></i>";
            }

            // avoid overlap, remove class completed from new active
            if(newActiveStepL.classList.contains("completedStep")) {
                newActiveStepL.classList.remove("completedStep");

                // replace checkmark with step number
                newActiveStepL.innerHTML = newActive;
            }
        }


        function next() {
            if(currentStep >= stepsNum) {
                alert("complete :)");
            } else {
                changeStep(currentStep, currentStep + 1);
                currentStep++;
                document.getElementById("prev").style.visibility = "visible";
            }
        }


        function prev() {
            if(currentStep >= 2) {
                changeStep(currentStep, currentStep - 1);
                currentStep--;

                if(currentStep < 2) {
                document.getElementById("prev").style.visibility = "hidden";
                }
            }
        }
    </script>
@endpush

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div id="container">
                    <div id="progressbarContainer">
                        <div id="emptyProgressbar"></div>
                        <div id="completedProgress"></div>
                        <ul>
                            <li id="stepLable1">1</li>
                            <li id="stepLable2">2</li>
                            <li id="stepLable3">3</li>
                            <li id="stepLable4">4</li>
                        </ul>
                    </div>
                    <div class="stepPage" id="stepPage1">
                        page 1
                    </div>
                    <div class="stepPage" id="stepPage2">
                        page 2
                    </div>
                    <div class="stepPage" id="stepPage3">
                        page 3
                    </div>
                    <div class="stepPage" id="stepPage4">
                        page 4
                    </div>
                    <nav>
                        <button id="prev" onclick="prev()"><</button>
                        <button id="next" onclick="next()">></button>
                    </nav>
                </div>
            </div><!--col-12-->
        </div><!--row-->
    </div><!--container-->
@endsection
