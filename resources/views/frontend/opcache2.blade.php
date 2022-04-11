@extends('frontend.layouts.app')

@push('before-styles')
<style>
    body {
        font-family: 'Helvetica Neue', 'Helvetica', 'Arial', 'sans-serif';
        margin: 0;
        padding: 0;
    }

    #container {
        width: 1024px;
        margin: auto;
        position: relative;
    }

    h1 {
        padding: 10px 0;
    }

    table {
        border-collapse: collapse;
    }

    tbody tr:nth-child(even) {
        background-color: #eee;
    }

    p.capitalize {
        text-transform: capitalize;
    }

    .tabs {
        position: relative;
        float: left;
        width: 60%;
    }

    .tab {
        float: left;
    }

    .tab label {
        background: #eee;
        padding: 10px 12px;
        border: 1px solid #ccc;
        margin-left: -1px;
        position: relative;
        left: 1px;
    }

    .tab [type=radio] {
        display: none;
    }

    .tab th, .tab td {
        padding: 8px 12px;
    }

    .content {
        position: absolute;
        top: 28px;
        left: 0;
        background: white;
        border: 1px solid #ccc;
        height: 450px;
        width: 100%;
        overflow: auto;
    }

    .content table {
        width: 100%;
    }

    .content th, .tab:nth-child(3) td {
        text-align: left;
    }

    .content td {
        text-align: right;
    }

    .clickable {
        cursor: pointer;
    }

    [type=radio]:checked ~ label {
        background: white;
        border-bottom: 1px solid white;
        z-index: 2;
    }

    [type=radio]:checked ~ label ~ .content {
        z-index: 1;
    }

    #graph {
        float: right;
        width: 40%;
        position: relative;
    }

    #graph > form {
        position: absolute;
        right: 60px;
        top: -20px;
    }

    #graph > svg {
        position: absolute;
        top: 0;
        right: 0;
    }

    #stats {
        position: absolute;
        right: 125px;
        top: 145px;
    }

    #stats th, #stats td {
        padding: 6px 10px;
        font-size: 0.8em;
    }

    #partition {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 10;
        top: 0;
        left: 0;
        background: #ddd;
        display: none;
    }

    #close-partition {
        display: none;
        position: absolute;
        z-index: 20;
        right: 15px;
        top: 15px;
        background: #f9373d;
        color: #fff;
        padding: 12px 15px;
    }

    #close-partition:hover {
        background: #D32F33;
        cursor: pointer;
    }

    #partition rect {
        stroke: #fff;
        fill: #aaa;
        fill-opacity: 1;
    }

    #partition rect.parent {
        cursor: pointer;
        fill: steelblue;
    }

    #partition text {
        pointer-events: none;
    }

    label {
        cursor: pointer;
    }
</style>
@endpush

@push('before-scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.0.1/d3.v3.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
    var hidden = {};
    function toggleVisible(head, row) {
        if (!hidden[row]) {
            d3.selectAll(row).transition().style('display', 'none');
            hidden[row] = true;
            d3.select(head).transition().style('color', '#ccc');
        } else {
            d3.selectAll(row).transition().style('display');
            hidden[row] = false;
            d3.select(head).transition().style('color', '#000');
        }
    }
</script>
<script>
    var dataset = {!! $getGraphDataSetJson !!};

    var width = 400,
        height = 400,
        radius = Math.min(width, height) / 2,
        colours = ['#B41F1F', '#1FB437', '#ff7f0e'];

    d3.scale.customColours = function() {
        return d3.scale.ordinal().range(colours);
    };

    var colour = d3.scale.customColours();
    var pie = d3.layout.pie().sort(null);

    var arc = d3.svg.arc().innerRadius(radius - 20).outerRadius(radius - 50);
    var svg = d3.select("#graph").append("svg")
                .attr("width", width)
                .attr("height", height)
                .append("g")
                .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

    var path = svg.selectAll("path")
                  .data(pie(dataset.memory))
                  .enter().append("path")
                  .attr("fill", function(d, i) { return colour(i); })
                  .attr("d", arc)
                  .each(function(d) { this._current = d; }); // store the initial values

    d3.selectAll("input").on("change", change);
    set_text("memory");

    function set_text(t) {
        if (t === "memory") {
            d3.select("#stats").html(
                "<table><tr><th style='background:#B41F1F;'>Used</th><td>{!! $getHumanUsedMemory !!}</td></tr>"+
                "<tr><th style='background:#1FB437;'>Free</th><td>{!! $getHumanFreeMemory !!}</td></tr>"+
                "<tr><th style='background:#ff7f0e;' rowspan=\"2\">Wasted</th><td>{!! $getHumanWastedMemory !!}</td></tr>"+
                "<tr><td>{!! $getWastedMemoryPercentage !!}%</td></tr></table>"
            );
        } else if (t === "keys") {
            d3.select("#stats").html(
                "<table><tr><th style='background:#B41F1F;'>Cached keys</th><td>"+format_value(dataset[t][0])+"</td></tr>"+
                "<tr><th style='background:#1FB437;'>Free Keys</th><td>"+format_value(dataset[t][1])+"</td></tr></table>"
            );
        } else if (t === "hits") {
            d3.select("#stats").html(
                "<table><tr><th style='background:#B41F1F;'>Misses</th><td>"+format_value(dataset[t][0])+"</td></tr>"+
                "<tr><th style='background:#1FB437;'>Cache Hits</th><td>"+format_value(dataset[t][1])+"</td></tr></table>"
            );
        } else if (t === "restarts") {
            d3.select("#stats").html(
                "<table><tr><th style='background:#B41F1F;'>Memory</th><td>"+dataset[t][0]+"</td></tr>"+
                "<tr><th style='background:#1FB437;'>Manual</th><td>"+dataset[t][1]+"</td></tr>"+
                "<tr><th style='background:#ff7f0e;'>Keys</th><td>"+dataset[t][2]+"</td></tr></table>"
            );
        }
    }

    function change() {
        // Filter out any zero values to see if there is anything left
        var remove_zero_values = dataset[this.value].filter(function(value) {
            return value > 0;
        });

        // Skip if the value is undefined for some reason
        if (typeof dataset[this.value] !== 'undefined' && remove_zero_values.length > 0) {
            $('#graph').find('> svg').show();
            path = path.data(pie(dataset[this.value])); // update the data
            path.transition().duration(750).attrTween("d", arcTween); // redraw the arcs
        // Hide the graph if we can't draw it correctly, not ideal but this works
        } else {
            $('#graph').find('> svg').hide();
        }

        set_text(this.value);
    }

    function arcTween(a) {
        var i = d3.interpolate(this._current, a);
        this._current = i(0);
        return function(t) {
            return arc(i(t));
        };
    }

    function size_for_humans(bytes) {
        if (bytes > 1048576) {
            return (bytes/1048576).toFixed(2) + ' MB';
        } else if (bytes > 1024) {
            return (bytes/1024).toFixed(2) + ' KB';
        } else return bytes + ' bytes';
    }

    function format_value(value) {
        if (dataset["TSEP"] == 1) {
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        } else {
            return value;
        }
    }

    var w = window.innerWidth,
        h = window.innerHeight,
        x = d3.scale.linear().range([0, w]),
        y = d3.scale.linear().range([0, h]);

    var vis = d3.select("#partition")
                .style("width", w + "px")
                .style("height", h + "px")
                .append("svg:svg")
                .attr("width", w)
                .attr("height", h);

    var partition = d3.layout.partition()
            .value(function(d) { return d.size; });

    root = JSON.parse('{!! $getD3Scripts !!}');

    var g = vis.selectAll("g")
               .data(partition.nodes(root))
               .enter().append("svg:g")
               .attr("transform", function(d) { return "translate(" + x(d.y) + "," + y(d.x) + ")"; })
               .on("click", click);

    var kx = w / root.dx,
            ky = h / 1;

    g.append("svg:rect")
     .attr("width", root.dy * kx)
     .attr("height", function(d) { return d.dx * ky; })
     .attr("class", function(d) { return d.children ? "parent" : "child"; });

    g.append("svg:text")
     .attr("transform", transform)
     .attr("dy", ".35em")
     .style("opacity", function(d) { return d.dx * ky > 12 ? 1 : 0; })
     .text(function(d) { return d.name; })

    d3.select(window)
      .on("click", function() { click(root); })

    function click(d) {
        if (!d.children) return;

        kx = (d.y ? w - 40 : w) / (1 - d.y);
        ky = h / d.dx;
        x.domain([d.y, 1]).range([d.y ? 40 : 0, w]);
        y.domain([d.x, d.x + d.dx]);

        var t = g.transition()
                 .duration(d3.event.altKey ? 7500 : 750)
                 .attr("transform", function(d) { return "translate(" + x(d.y) + "," + y(d.x) + ")"; });

        t.select("rect")
         .attr("width", d.dy * kx)
         .attr("height", function(d) { return d.dx * ky; });

        t.select("text")
         .attr("transform", transform)
         .style("opacity", function(d) { return d.dx * ky > 12 ? 1 : 0; });

        d3.event.stopPropagation();
    }

    function transform(d) {
        return "translate(8," + d.dx * ky / 2 + ")";
    }

    $(document).ready(function() {

        function handleVisualisationToggle(close) {

            $('#partition, #close-partition').fadeToggle();

            // Is the visualisation being closed? If so show the status tab again
            if (close) {

                $('#tab-visualise').removeAttr('checked');
                $('#tab-status').trigger('click');

            }

        }

        $('label[for="tab-visualise"], #close-partition').on('click', function() {

            handleVisualisationToggle(($(this).attr('id') === 'close-partition'));

        });

        $(document).keyup(function(e) {

            if (e.keyCode == 27) handleVisualisationToggle(true);

        });

    });
</script>
@endpush

@section('content')
<div class="container" id="container">
    <h1>{!! $getPageTitle !!}</h1>

    <div class="tabs">

        <div class="tab">
            <input type="radio" id="tab-status" name="tab-group-1" checked>
            <label for="tab-status">Status</label>
            <div class="content">
                <table>
                    {!! $getStatusDataRows !!}
                </table>
            </div>
        </div>

        <div class="tab">
            <input type="radio" id="tab-config" name="tab-group-1">
            <label for="tab-config">Configuration</label>
            <div class="content">
                <table>
                    {!! $getConfigDataRows !!}
                </table>
            </div>
        </div>

        <div class="tab">
            <input type="radio" id="tab-scripts" name="tab-group-1">
            <label for="tab-scripts">Scripts ({!! $getScriptStatusCount !!})</label>
            <div class="content">
                <table style="font-size:0.8em;">
                    <tr>
                        <th width="10%">Hits</th>
                        <th width="20%">Memory</th>
                        <th width="70%">Path</th>
                    </tr>
                    {!! $getScriptStatusRows !!}
                </table>
            </div>
        </div>

        <div class="tab">
            <input type="radio" id="tab-visualise" name="tab-group-1">
            <label for="tab-visualise">Visualise Partition</label>
            <div class="content"></div>
        </div>

    </div>

    <div id="graph">
        <form>
            <label><input type="radio" name="dataset" value="memory" checked> Memory</label>
            <label><input type="radio" name="dataset" value="keys"> Keys</label>
            <label><input type="radio" name="dataset" value="hits"> Hits</label>
            <label><input type="radio" name="dataset" value="restarts"> Restarts</label>
        </form>

        <div id="stats"></div>
    </div>
</div>

<div id="close-partition">&#10006; Close Visualisation</div>
<div id="partition"></div>

@endsection
