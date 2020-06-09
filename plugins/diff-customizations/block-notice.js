( function( wp ) {
    wp.data.dispatch('core/notices').createNotice(
        'info', // Can be one of: success, info, warning, error.
        'Welcome to Diff. Please review the', // Text string to display.
        {
            isDismissible: true, // Whether the user can dismiss the notice.
            // Any actions the user can perform.
            actions: [
                {
                    url: 'https://#',
                    label: 'editorial guidelines.'
                }
            ]
        }
    );
} )( window.wp );