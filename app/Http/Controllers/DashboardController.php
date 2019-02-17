<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Offer;

class DashboardController extends Controller
{
    public function getDailyAddedOffersUSA(){
        $offersMonthlyInfo = array();
        $dates = collect();
        
        foreach( range( -30, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            $dates->put( $date, 0);
        }

        $countAddedOffers = DB::table('offers')->where([['created_at', '>=', $dates->keys()->first()], ['country', 'USA']])
                                ->groupBy( 'date' )
                                ->groupBy( 'brand' )
                                ->orderBy( 'date' )
                                ->get( [
                                    DB::raw( 'DATE( created_at ) as date' ),
                                    DB::raw( 'COUNT(brand) AS "count"' ),
                                    'brand'
                                ] );

        // create the array to contain the objects
        $arrayOfAddedBrands = [];
        foreach($countAddedOffers as $brand){
            $found = 0;
            // looping over the array to search for the date if it exists 
            foreach($arrayOfAddedBrands as $key => $brandFromArray ){
              // if the date exists
              if($brand->date == $brandFromArray->date){
                  // add the brand to the clubs object
                  //$brandFromArray->offers->{$brand->brand} = $brand->count;
                  $brandFromArray->{$brand->brand} = $brand->count;

                  $found = 1;
                  // assign the array element to the new modified object
                  $arrayOfAddedBrands[$key] = $brandFromArray;
                  break;
              }
            }
            // if the date not found
            if(!$found){
               // create new object and assign the date to it
               $brandObject = new \stdClass;
               $brandObject->date = $brand->date;
               // creating the clubs object
               //$brandObject->offers = new \stdClass;
               //$brandObject->offers->{$brand->brand} = $brand->count;


               $brandObject->{$brand->brand} = $brand->count;
               // adding the final object to the array
               $arrayOfAddedBrands[] = $brandObject;
             }
         }
        
        return $arrayOfAddedBrands;
    }

    public function getDailyAddedOffersUK(){
        $offersMonthlyInfo = array();
        $dates = collect();
        
        foreach( range( -30, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            $dates->put( $date, 0);
        }

        $countAddedOffers = DB::table('offers')->where([['created_at', '>=', $dates->keys()->first()], ['country', 'UK']])
                                ->groupBy( 'date' )
                                ->groupBy( 'brand' )
                                ->orderBy( 'date' )
                                ->get( [
                                    DB::raw( 'DATE( created_at ) as date' ),
                                    DB::raw( 'COUNT(brand) AS "count"' ),
                                    'brand'
                                ] );
        $arrayOfAddedBrands = [];
        foreach($countAddedOffers as $brand){
            $found = 0;
            foreach($arrayOfAddedBrands as $key => $brandFromArray ){
              if($brand->date == $brandFromArray->date){
                  $brandFromArray->{$brand->brand} = $brand->count;
                  $found = 1;
                  $arrayOfAddedBrands[$key] = $brandFromArray;
                  break;
              }
            }
            if(!$found){
               $brandObject = new \stdClass;
               $brandObject->date = $brand->date;
               $brandObject->{$brand->brand} = $brand->count;
               $arrayOfAddedBrands[] = $brandObject;
             }
         }
        
        return $arrayOfAddedBrands;
    }

    public function getDailyAddedOffersPL(){
        $offersMonthlyInfo = array();
        $dates = collect();
        
        foreach( range( -30, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            $dates->put( $date, 0);
        }

        $countAddedOffers = DB::table('offers')->where([['created_at', '>=', $dates->keys()->first()], ['country', 'PL']])
                                ->groupBy( 'date' )
                                ->groupBy( 'brand' )
                                ->orderBy( 'date' )
                                ->get( [
                                    DB::raw( 'DATE( created_at ) as date' ),
                                    DB::raw( 'COUNT(brand) AS "count"' ),
                                    'brand'
                                ] );
        $arrayOfAddedBrands = [];
        foreach($countAddedOffers as $brand){
            $found = 0;
            foreach($arrayOfAddedBrands as $key => $brandFromArray ){
              if($brand->date == $brandFromArray->date){
                  $brandFromArray->{$brand->brand} = $brand->count;
                  $found = 1;
                  $arrayOfAddedBrands[$key] = $brandFromArray;
                  break;
              }
            }
            if(!$found){
               $brandObject = new \stdClass;
               $brandObject->date = $brand->date;
               $brandObject->{$brand->brand} = $brand->count;
               $arrayOfAddedBrands[] = $brandObject;
             }
         }
        
        return $arrayOfAddedBrands;
    }
}
