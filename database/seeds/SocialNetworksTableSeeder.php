<?php

use Illuminate\Database\Seeder;

class SocialNetworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //delete types table records
        DB::table('social_networks')->delete();

        //insert records
        DB::table('social_networks')->insert([
            ['name' => 'Facebook',      'logo' => '/images/circular_icon_set/facebook.png',     'url' => 'facebook.com/%'],
            ['name' => 'Twitter',       'logo' => '/images/circular_icon_set/twitter.png',      'url' => 'twitter.com/%'],
            ['name' => 'Blogger',       'logo' => '/images/circular_icon_set/blogger.png',      'url' => '%.blogspot.com'],
            ['name' => 'Delicious',     'logo' => '/images/circular_icon_set/delicious.png',    'url' => 'delicious.com/%'],
            ['name' => 'Digg',          'logo' => '/images/circular_icon_set/digg.png',         'url' => 'digg.com/%'],
            ['name' => 'eBay',          'logo' => '/images/circular_icon_set/ebay.png',         'url' => 'stores.ebay.com/%'],
            ['name' => 'Flickr',        'logo' => '/images/circular_icon_set/flickr.png',       'url' => 'flickr.com/photos/%'],
            ['name' => 'Google plus',   'logo' => '/images/circular_icon_set/google.png',       'url' => 'google.com/+%'],
            ['name' => 'Linkedin',      'logo' => '/images/circular_icon_set/linkedin.png',     'url' => 'linkedin.com/%'],
            ['name' => 'My Space',      'logo' => '/images/circular_icon_set/myspace.png',      'url' => 'myspace.com/%'],
            ['name' => 'reddit',        'logo' => '/images/circular_icon_set/reddit.png',       'url' => 'www.reddit.com/r/%'],
            ['name' => 'Stumbleupon',   'logo' => '/images/circular_icon_set/stumbleupon.png',  'url' => 'www.stumbleupon.com/stumbler/%'],
            ['name' => 'Wordpress',     'logo' => '/images/circular_icon_set/wordpress.png',    'url' => '%.wordpress.com'],
            ['name' => 'Youtube',       'logo' => '/images/circular_icon_set/youtube.png',      'url' => 'youtube.com/c/%']
         ]);
    }
}
