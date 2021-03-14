<!-- /resources/views/products/_candlestick-chart -->

<h2 class="accordion-header" id="headingThree">
    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#raw-data" aria-expanded="false" aria-controls="raw-data">
        Results
    </button>
</h2>
<div id="raw-data" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionHistory">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Time</th>
                    <th>Low</th>
                    <th>High</th>
                    <th>Open</th>
                    <th>Close</th>
                    <th>Volume</th>
                </tr>
            </thead>
            <tbody>
                @foreach($history as $index=>$entry)
                <tr>
                    <td>{{$index + 1}}</td>
                    <td>{{date('m/d/Y h:i A', $entry[0])}}</td>
                    <td>${{number_format($entry[1], 2)}}</td>
                    <td>${{number_format($entry[2], 2)}}</td>
                    <td>${{number_format($entry[3], 2)}}</td>
                    <td>${{number_format($entry[4], 2)}}</td>
                    <td>{{number_format($entry[5], 4)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
