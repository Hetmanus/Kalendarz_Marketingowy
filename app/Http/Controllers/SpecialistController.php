<?php

namespace App\Http\Controllers;

class SpecialistController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function addAction()
    {
        $budget = 80000;
        $concepts = ['Sportowy', 'koncept2', 'koncept3'];
        $shops = [
			//Sportowy koncept
			[
				'sportowysklep.pl', 
				'brodnica', 
				'sklep3', 
				'sklep4'
			],
			//koncept2 koncept			
			[
				'sklep5'
			],
			//koncept3 koncept
			[
				'ilawa', 
				'costam0', 
				'costam1'
			]
		];

        return view('pages/addAction', compact('budget', 'concepts', 'shops'));
    }
}
