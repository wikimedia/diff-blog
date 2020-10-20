;(function($) {
  $('.single-filing').each(function() {
    var $filing = $(this)

    var year = $filing.find('.left-label > .small-label ~ .small-label + h4').text();

    if (year && parseInt(year) < radfunds_returns.earliest_report_year ) {
      $filing.remove();
    }
    /*
    $filing.find('a')
      .attr('target', '_blank')
      .attr('rel', 'nofollow')
    */

    $filing.find('select.action')
      .removeClass('action')
      .on('change', function(e) {
        window.location.href = this.options [ this.selectedIndex ].getAttribute( 'data-href' )
      })
      .find('option:first-child')
        .text('Schedules')
  })
})(jQuery)