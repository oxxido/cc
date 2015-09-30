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
        DB::table('social_networks')->delete();

        DB::table('social_networks')->insert([
            ['uuid' => Uuid::generate(), 'name' => 'Facebook',      'logo' => '/images/circular_icon_set/facebook.png',     'url' => 'facebook.com/%'],
            ['uuid' => Uuid::generate(), 'name' => 'Twitter',       'logo' => '/images/circular_icon_set/twitter.png',      'url' => 'twitter.com/%'],
            ['uuid' => Uuid::generate(), 'name' => 'Blogger',       'logo' => '/images/circular_icon_set/blogger.png',      'url' => '%.blogspot.com'],
            ['uuid' => Uuid::generate(), 'name' => 'Delicious',     'logo' => '/images/circular_icon_set/delicious.png',    'url' => 'delicious.com/%'],
            ['uuid' => Uuid::generate(), 'name' => 'Digg',          'logo' => '/images/circular_icon_set/digg.png',         'url' => 'digg.com/%'],
            ['uuid' => Uuid::generate(), 'name' => 'eBay',          'logo' => '/images/circular_icon_set/ebay.png',         'url' => 'stores.ebay.com/%'],
            ['uuid' => Uuid::generate(), 'name' => 'Flickr',        'logo' => '/images/circular_icon_set/flickr.png',       'url' => 'flickr.com/photos/%'],
            ['uuid' => Uuid::generate(), 'name' => 'Google plus',   'logo' => '/images/circular_icon_set/google.png',       'url' => 'google.com/+%'],
            ['uuid' => Uuid::generate(), 'name' => 'Linkedin',      'logo' => '/images/circular_icon_set/linkedin.png',     'url' => 'linkedin.com/%'],
            ['uuid' => Uuid::generate(), 'name' => 'My Space',      'logo' => '/images/circular_icon_set/myspace.png',      'url' => 'myspace.com/%'],
            ['uuid' => Uuid::generate(), 'name' => 'reddit',        'logo' => '/images/circular_icon_set/reddit.png',       'url' => 'www.reddit.com/r/%'],
            ['uuid' => Uuid::generate(), 'name' => 'Stumbleupon',   'logo' => '/images/circular_icon_set/stumbleupon.png',  'url' => 'www.stumbleupon.com/stumbler/%'],
            ['uuid' => Uuid::generate(), 'name' => 'Wordpress',     'logo' => '/images/circular_icon_set/wordpress.png',    'url' => '%.wordpress.com'],
            ['uuid' => Uuid::generate(), 'name' => 'Youtube',       'logo' => '/images/circular_icon_set/youtube.png',      'url' => 'youtube.com/c/%']
         ]);
    }
}
