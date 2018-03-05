<?php

namespace App\Http\Controllers;

class ObserverController extends Controller
{
    public function index($conceptFlag = 255)
    {
	if($conceptFlag > 255)
	{
		return redirect('/calendar');
	}

	$concepts = ['Sportowy', 'koncept2', 'koncept3'];
	$conceptsActions = 
		[
			//Sportowy koncept
			[
				[
					'Akcja 1',
					'y, m, 1',
					'y, m, 1',
					'true',
					'0',
					'#f56954',
					'#f56954'
				],
				[
					'Akcja 2',
					'y, m, d+5',
					'y, m, d+7',
					'true',
					'0',
					'#f39c12',
					'#f39c12'
				]
			],
			//koncept2 koncept			
			[
				[
					'Akcja 3',
					'y, m, d-5',
					'y, m, d-2',
					'true',
					'0',
					'#00a65a',
					'#00a65a'
				]
			],
			//koncept3 koncept
			[
				[
					'Akcja 4',
					'y, m, 28',
					'y, m, 29',
					'true',
					'0',
					'#00a65a',
					'#00a65a'
				]
			]
		];

        return view('pages/calendar', 
		compact('concepts', 'conceptsActions', 'conceptFlag'));
    }
}
