@extends('template')

@section('title', 'Test')

@section('content')
  <a id="blastBtn" class="btn btn-lg btn-outline-primary" href="javascript:void(0)">
    BLAST ME!
  </a>
  <a id="ridBtn" class="btn btn-lg btn-outline-primary" href="javascript:void(0)">
    SEE REPORT HERE!
  </a>
</body>
<div class="spinner-grow text-primary" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-secondary" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-success" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-danger" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-warning" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-info" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-light" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-dark" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div id="the-basics">
  <input class="form-control typeahead" type="text" placeholder="States of USA">
</div>
  <script src="/js/typeahead.bundle.js"></script>
  <script src="/js/jquery.redirect.js"></script>
  <script>
  $(document).ready(function() {
    $("#blastBtn").click(function() {
      let ncbiUrl = "https://blast.ncbi.nlm.nih.gov/Blast.cgi";
      let rRNA = ">FW305-130\nGCAGTCGAGCGGTAAGGCCTTTCGGGGTACACGAGCGGCGAACGGGTGAGTAACACGTGGGTGATCTGCCCTGCACTTCGGGATAAGCCTGGGAAACTGGGTCTAATACCGGATATGACCTCAGGTTGCATGACTTGGGGTGGAAAGATTTATCGGTGCAGGATGGGCCCGCGGCCTATCAGCTTGTTGGTGGGGTAATGGCCTACCAAGGCGACGACGGGTAGCCGACCTGAGAGGGTGACCGGCCACACTGGGACTGAGACACGGCCCAGACTCCTACGGGAGGCAGCAGTGGGGAATATTGCACAATGGGCGAAAGCCTGATGCAGCGACGCCGCGTGAGGGATGACGGCCTTCGGGTTGTAAACCTCTTTCAGCAGGGACGAAGCGCAAGTGACGGTACCTGCAGAAGAAGCACCGGCTAACTACGTGCCAGCAGCCGCGGTAATACGTAGGGTGCAAGCGTTGTCCGGAATTACTGGGCGTAAAGAGTTCGTAGGCGGTTTGTCGCGTCGTTTGTGAAAACCAGCAGCTCAACTGCTGGCTTGCAGGCGATACGGGCAGACTTGAGTACTGCAGGGGAGACTGGAATTCCTGGTGTAGCGGTGAAATGCGCAGATATCAGGAGGAACACCGGTGGCGAAGGCGGGTCTCTGGGCAGTAACTGACGCTGAGGAACGAAAGCGTGGGTAGCGAACAGGATTAGATACCCTGGTAGTCCACGCCGTAAACGGTGGGCGCTAGGTGTGGGTTCCTTCCACGGAATCCGTGCCGTAGCTAACGCATTAAGCGCCCCGCCTGGGGAGTACGGCCGCAAGGCTAAAACTCAAAGGAATTGACGGGGGCCCGCACAAGCGGCGGAGCATGTGGATTAATTCGATGCAACGCGAAGAACCTTACCTGGGGTTTGACATATACCGGAAAGCTGCAGAGATGTGGCCCCCCTTGTGGTCGGTATACAGGTGGTGCATGGCTGTCGTCAGCTCGTGTCGTGAGATGTTGGGTTAAGTCCCGCAACGAGCGCAACCCCTATCTTATGTTGCCAGCACGTTATGGTGGGGACTCGTAAGAGACTGCCGGGGTCAACTCGGAGGAAGGTGGGGACGACGTCAAGTCATCATGCCCCTTATGTCCAGGGCTTCACACATGCTACAATGGCCAGTACAGAGGGCTGCGAGACCGTGAGGTGGAGCGAATCCCTTAAAGCTGGTCTCAGTTCGGATCGGGGTCTGCAACTCGACCCCGTGAAGTNGGAGTCGCTAGTAATCGCAGATCAGCAACGCTGCGGTGAATACGTTCCCGGGCCTTGTACACACCGCCCGTCACGTCATGAAAGTCGGTAACACCCGAAGCCGGTGGCT";
      let postData = {
        "CMD": "Put",
        "PROGRAM": "blastn",
        "MEGABLAST": "on",
        "DATABASE": "nr",
        "QUERY": rRNA
      };
      $.redirect(ncbiUrl, postData, "POST", "_blank");
    });

    $("#ridBtn").click(function() {
      let ncbiUrl = "https://blast.ncbi.nlm.nih.gov/Blast.cgi";
      let postData = {
        "CMD": "Get",
        "FORMAT_TYPE": "HTML",
        "RID": "23GWEB0R015",
        "SHOW_OVERVIEW": "on"
      };
      $.redirect(ncbiUrl, postData, "POST", "_blank");
    });

    var substringMatcher = function(strs) {
      return function findMatches(q, cb) {
        var matches, substringRegex;

        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function(i, str) {
          if (substrRegex.test(str)) {
            matches.push(str);
          }
        });

        cb(matches);
      };
    };
    
    // function(query, process) {
    //    return $.get('/api/v1/isolates/hint/'+encodeURI(query), function(data) {
    //      console.log(data);
    //      return process(data);
    //    });
    //  }

    var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
      'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
      'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
      'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
      'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
      'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
      'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
      'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
      'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
    ];

    $('#the-basics .typeahead').typeahead({
      hint: true,
      highlight: true,
      minLength: 3
    },
    {
      limit: 5,
      async: true,
      source: function(query, processSync, process) {
        processSync([]);
        return $.get('/api/v1/isolates/hint/'+encodeURI(query), function(data) {
          console.log(data);
          return process(data);
        });
      }
    });
  });
  </script>
@endsection
