<?php

/**
 * Created by PhpStorm.
 * User: LaravelDude
 * Date: 1/8/16
 * Time: 7:21 PM.
 */
namespace app\Tools\Pages;

/*
 * Class Page
 * @package App\Tools\Pages
 */
use Illuminate\Support\Collection;

/**
 * Class Page.
 */
class Page
{
    /**
     * @var array
     */
    protected $athletes = [
        'joey-swoll' => [
            'name' => 'Joey Swoll',
            'gender' => 'male',
            'country' => 'USA',
            'instagram_handle' => 'joeyswoll',
            'hero' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/joeyswoll/hero.jpg',
            'aboutleft' => 'Joey is the original Shredz Athlete and hasn’t stopped motivating people to reach their goals since the day he began the movement. His powerful physique and relentless work ethic both in and outside of the gym is what has given him such popularity in the fitness community. You can find him at gyms across the US and the globe, taking time to hear his fan’s stories and help them through their own personal process.',
            'aboutright' => 'Joey is originally from a small town outside of Chicago, and hasn’t forgotten his humble beginnings. He is a testament to the fact that you, just like the Shredz Movement, can build yourself from scratch with hard work, the right knowledge, and a positive attitude.',
            'workout_images' => [
                'image1' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/joeyswoll/workout_image1.jpg',
                'image2' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/joeyswoll/workout_image2.jpg',
                'image3' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/joeyswoll/workout_image3.jpg',
                'image4' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/joeyswoll/workout_image4.jpg',
            ],
            'quote' => 'I don’t care how much weight you lifted in the gym today. I care more if you held the door for the person walking in behind you.',
            'video' => 'https://www.youtube.com/embed/9M3w6zxNEFQ',
            'recommended' => [
                [
                    'product_id' => '2',
                    'image' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/CORE%20Creatine.jpg',
                    'link' => '(Product ID 2) Product Page',
                    'text' => 'Joey Uses SHREDZ Creatine Religiously
                    “Why would you go into the gym at 80% if you have the tools to come in at 100%? This stuff helps me get an extra rep on every set, which really adds up.”',
                ],
                [
                    'product_id' => '76',
                    'image' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/CORE%20BCAA.jpg',
                    'Link' => '(Product ID 76) Product Page',
                    'text' => 'Joey Drinks BCAA + Glutamine every single day
                    “I rarely take a day off from the gym, and if I do, I don’t want to stop rebuilding. A day off from the gym isn’t a day off from the lifestyle. I drink amino acids all day, every day.”',
                ],
            ],
            'thumbnail' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/joeyswoll/thumbnail.jpg',
        ],
        'jessica-arevalo' => [
            'name' => 'Jessica Arevalo',
            'gender' => 'female',
            'country' => 'USA',
            'instagram_handle' => 'jessicaarevalo_',
            'hero' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/jessicaarevalo/hero.jpg',
            'aboutleft' => 'An Olympian competitor, fitness model, and Shredz Athlete, Jessica prides herself on being a lifetime natural athlete, influencing and empowering women in the health and fitness world! Jessica got started with bodybuilding with her dad at the young age of 17. Her dad taught her the Arnold style of training, which got her to hit the gym 5 days a week, focusing on lifting heavy weights to put on muscle on her petite frame. It was this mindset that allowed Jessica to reach an elite level in bikini competition.',
            'aboutright' => 'Before entering into the fitness world, Jessica struggled with depression and began drinking heavily to cope with her emotions and anxiety. At 25, Jessica made the decision to do her first bikini competition, not only give herself a healthy goal, but to prevent herself from drinking. 30 shows and 2 Olympia appearances later, she has developed one of the best bodies on in the fitness world and has since been committed to sharing her story with others.',
            'workout_images' => [
                'image1' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/jessicaarevalo/workout_image1.jpg',
                'image2' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/jessicaarevalo/workout_image2.jpg',
                'image3' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/jessicaarevalo/workout_image3.jpg',
                'image4' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/jessicaarevalo/workout_image4.jpg',
            ],
            'quote' => 'Learn to inspire yourself and you can tackle any challenge.',
            'video' => 'https://www.youtube.com/embed/mQySw2SkDmo',
            'recommended' => [
                [
                   'product_id' => '543',
                   'image' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/MFW%20Burner%20Max.jpg',
                   'Link' => '(Product ID 543) Product Page',
                   'text' => 'She loves using Shredz BurnerMax.
                   “My day usually begins with a morning cardio session, followed by social media posts and daily photo shoots. The Burner Max helps keep my body lean and give me energy to sustain my long and sometimes hectic days.',
                ],
                [
                   'product_id' => '60',
                   'image' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/MFW%20BCAA.jpg',
                   'Link' => '(Product ID 60) Product Page',
                   'text' => 'Jessica keeps her muscles round and full with BCAA+Glutamine.
                    “I always bring my Shredz BCAA + Glutamine powder with me to all of my cardio sessions. The pink lemonade flavor is amazing and I never feel totally depleted or deprived.”',
                ],
            ],
            'thumbnail' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/jessicaarevalo/thumbnail.jpg',
        ],
        'lazar-angelov' => [
            'name' => 'Lazar Angelov',
            'gender' => 'male',
            'country' => 'BULGARIA',
            'instagram_handle' => 'lazar_angelov_official',
            'hero' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/lazarangelov/hero.jpg',
            'aboutleft' => 'Before becoming a SHREDZ Athlete, bodybuilder, and a personal trainer, Lazar Angelov played professional basketball for 10 years, being one of the best point guards on the National Basketball Association of Bulgaria. At the young age of 18, Lazar joined the army, where he discovered his love for bodybuilding. It instantly became a huge part of his life and he soon pursued his personal training certification from the National Academy of Sports Medicine and started working with people, helping them to reach their maximum potential in developing their bodies.',
            'aboutright'=> 'Since 2006, Lazar has dedicated his life to health and fitness, taking part in different competitions, while never failing to win at least a bronze medal ever time. His ambition and motivation have inspired millions of people around the world and he has become one of the most influential SHREDZ Athletes over the past several years. Lazar continues to
                find motivation from his fans and clients, who he helped transform their lifestyles and bodies and he doesn’t plan on stopping anytime soon in his fitness journey.',
            'workout_images'=>[
            'image1'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/lazarangelov/workout_image1.jpg',
            'image2'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/lazarangelov/workout_image2.jpg',
            'image3'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/lazarangelov/workout_image3.jpg',
            'image4'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/lazarangelov/workout_image4.jpg',
            ],
            'quote'=> 'Most people believe that once you have achieved the body that you always wanted, verything else comes easy after that. It costs me as much effort to stay in this shape as it cost me to achieve it; I have to give 100% all the time.',
            'video' => 'https://www.youtube.com/embed/KqZ9vE5goFc',
            'recommended' => [
                    [
                       'product_id'=>'11',
                       'image'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/CORE%20Protein.jpg',
                       'Link'=>'(Product ID 11) Product Page',
                        'text'=>'Lazar uses SHREDZ Protein “Staying consistent with my diet and training is important to me and my body. This isn’t always easy but my SHREDZ protein powder helps me keep quality mass while also increasing strength in the gym year round.”',
                    ],
                    [
                       'product_id'=>'76',
                       'image'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/CORE%20BCAA.jpg',
                       'Link'=>'(Product ID 76) Product Page',
                        'text'=>'Lazar loves the taste of the BCAA and how it aids in muscle recovery “Coming back from an injury, heavy workouts are intense on my body so I’m glad I have my SHREDZ BCAAs to help me recover.”',
                    ]
                ],
                'thumbnail'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/lazarangelov/thumbnail.jpg'
        ],
         'bella_falconi' => [
            'name' => 'Bella Falconi',
            'gender'=> 'female',
            'instagram_handle'=>'bellafalconi',
            'country' => 'USA',
            'hero'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/bellafalconi/hero.jpg',
            'aboutleft' => 'Published fitness model, proud mother, SHREDZ Athlete and certified personal trainer and life coach, Bella Falconi is a true fitness icon! Bella has a degree in Nutrition and is one of the most influential people in the fitness universe, with more than 2.5 million followers on social media. Bella has won two bodybuilding Championships, including NPC and WBFF, as well as her Pro-Card as an athlete.',
            'aboutright'=>'Bella\'s dedication, mission and passion for helping others has been her one of the most empowering and influential women in the training and fitness scene, and she doesn’t take her job lightly. Bella is always seeking to make improvements to her own life and the lives of her clients, always striving to learn something new and improve on all areas of her training and nutrition.',
        'workout_images' =>[
            'image1'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/bellafalconi/workout_image1.jpg',
            'image2'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/bellafalconi/workout_image2.jpg',
            'image3'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/bellafalconi/workout_image3.jpg',
            'image4'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/bellafalconi/workout_image4.jpg',
        ],
        'quote'=>'Being able to help others through my own transformation is something that I have definitely embraced as a life mission.',
        'video'=>'https://www.youtube.com/embed/vAKblWWf6j8',
        'recommended' =>[
            [
            'product_id'=> '6',
            'image'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/MFW%20Toner.jpg',
            'Link'=> '(Product ID 6) Product Page',
            'text'=> 'Bella uses Toner to keep her cuts. “I love the SHREDZ Toner to help me recover quicker in the gym and help push me through my cardio sessions; I also really enjoy training with more weights and concentrated movements, so the toner allows me to get the most out of my workouts!"'
            ],
            [
            'product_id'=>'60',
            'image'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/MFW%20BCAA.jpg',
            'Link'=>'(Product ID 60) Product Page',
            'text'=>'SHREDZ BCAA + Glutamine is a must for Bella\'s workouts “With such rigorous workouts and kickboxing sessions, the SHREDZ BCAA makes sure my muscles recover quick and I am not sore.”',
            ]
        ],
        'thumbnail'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/bellafalconi/thumbnail.jpg'
        ],
        'andreia-brazier' => [
            'name' => 'Andreia Brazier',
            'gender'=>'female',
            'instagram_handle'=>'andreiabrazier',
            'country' => 'DUBAI',
            'hero'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/andreiabrazier/hero.jpg',
            'aboutleft'=>'WBFF Pro World Champion, Fitness model and SHREDZ Athlete, Andreia began her journey for physical training at the young age of 14 in Porto Alegre, Brazil. It was then when she had her first encounter with the gym and weight training. Immediately she felt she had found her true place and love for maintaining a healthy lifestyle.',
            'aboutright'=>'Andreia moved to England where she kept working on herself and started competing in various fitness competitions. Andreia has since became a World Competitor with 4 consecutive WBFF Championships under her belt. Her vast knowledge base in health and fitness, combined with her 20 years of experience in the industry has allowed her to become a true ambassador for living a healthy life.',
            'workout_images'=>[
            'image1'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/andreiabrazier/workout_image1.jpg',
            'image2'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/andreiabrazier/workout_image2.jpg',
            'image3'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/andreiabrazier/workout_image3.jpg',
            'image4'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/andreiabrazier/workout_image4.jpg',
            ],
            'quote' => 'I love the fitness lifestyle so much and I have always wanted to dominate in this sport. In everything I do I always give it my absolute 100%.',
            'video'=>'https://www.youtube.com/embed/0XFnERLMjOM',
            'recommended'=>[
                    [
                   'product_id'=>'543',
                   'image'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/MFW%20Burner%20Max.jpg',
                   'Link'=>'(Product ID 543) Product Page',
                   'text'=>'Andreia uses BurnerMax to keep in the best shape “I train hard all year round; I need my energy levels and recovery to be working at optimal levels. I enjoy keeping a shredded figure and I work hard for it with the help of the Burner Max."'
                   ],
                   [
                   'product_id'=>'6',
                   'image'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/MFW%20Toner.jpg',
                   'Link'=>'(Product ID 6) Product Page',
                    'text'=>'Andreia uses Toner for energy “If I can continue to hit the gym hard and continue working on the body
                    I’ve always wanted then there really is no slowing down for me in the near future, SHREDZ Toner helps me push through all of my workouts"'
                    ]
                ],
                'thumbnail'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/andreiabrazier/thumbnail.jpg'
        ],
        'ainsley-rodriguez' => [
            'name' => 'Ainsley Rodriguez',
            'gender' => 'female',
            'country' => 'USA',
            'instagram_handle' => 'hardcoreainsley',
            'hero' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/ainsleyrodriguez/hero.jpg',
            'aboutleft' => 'A fitness model, female bodybuilder, and nutritionist, Ainsley Rodriguez is the epitome of a female fitness icon. Before being signed with Shredz in 2013, she was studying for Medical School and working part-time as a teacher, helping others learn. Her passion for nutrition, combined with her desire to teach others about living a healthy life makes her a natural leader in the world of fitness.',
            'aboutright' => 'After graduating Magna Cum Laude from FIU with a Bachelors in Biology, Ainsley closed the books and focused her attention on another passion of hers, helping others struggling in their own skin. Ainsley takes tremendous pride in living a healthy life inside and outside of the gym. She continues to encourage women to take advantage of the health benefits of lifting weights and eating a wholesome diet.',
            'workout_images' => [
                'image1' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/ainsleyrodriguez/workout_image1.jpg',
                'image2' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/ainsleyrodriguez/workout_image2.jpg',
                'image3' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/ainsleyrodriguez/workout_image3.jpg',
                'image4' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/ainsleyrodriguez/workout_image4.jpg',
            ],
            'quote' => 'Never let anyone say no to your ambitions!',
            'video' => 'https://www.youtube.com/embed/DMza8I9EDos',
            'recommended' => [
                [
                    'product_id' => '617',
                    'image' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/Alpha%20Female.jpg',
                    'Link' => '(Product ID 617) Product Page',
                    'text' => 'Ainsley uses the Alpha Female Stack from SHREDZ.
                    “I’ve always struggled with muscle loss when cutting and SHREDZ has been proven to be effective and allowed me to maintain my muscle and keep my curves while dropping body fat!”',
                ],
                [
                    'product_id' => '6',
                    'image' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/MFW%20Toner.jpg',
                    'Link' => '(Product ID 6) Product Page',
                    'text' => 'Ainsley uses Toner to help her maintain her curves.
                    “I’ve found that building and keeping muscle is hard when you’re trying to stay lean all year. Toner has been a huge help for me and has taken my levels up a notch.”',
                ],
            ],
            'thumbnail' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/ainsleyrodriguez/thumbnail.jpg',
        ],
        'nikki-leonard' => [
            'name' => 'Nikki Leonard',
            'gender' => 'female',
            'country' => 'USA',
            'instagram_handle' => 'nikkirica',
            'hero' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/nikkileonard/hero.jpg',
            'aboutleft' => 'Nikki grew up playing sports her entire life, including soccer and lacrosse. She was talented enough to play lacrosse at the NCAA level, but once college was over she knew she need a new form of physical activity. Her step-dad, a long-time bodybuilding fan, suggested she try physique sports.  After Nikki dedicated herself to this new fitness goal, she found herself taking home the first place spot in her first two competitions.',
            'aboutright' => 'Nikki has become obsessed with Crossfit, a type of exercise she felt challenge her mind and body. She began competing in Crossfit competitions in 2013 and doesn’t plan on slowing down anytime soon. Besides hitting PR’s in the gym and crushing Crossfit WODs, Nikki loves dogs, being outdoors, traveling, adventure, fitness, coaching, helping others and all things music.',
            'workout_images' => [
                'image1' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/nikkileonard/workout_image1.jpg',
                'image2' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/nikkileonard/workout_image2.jpg',
                'image3' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/nikkileonard/workout_image3.jpg',
                'image4' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/nikkileonard/workout_image4.jpg',
            ],
            'quote' => 'Present yourself with a new challenge each day and at the end of the year, look back and see how far you\'ve come.',
            'video' => 'https://www.youtube.com/embed/rISjgApEjiE',
            'recommended' => [
                [
                   'product_id' => '60',
                   'image' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/MFW%20BCAA.jpg',
                   'Link' => '(Product ID 60) Product Page',
                   'text' => ' Nikki loves using SHREDZ BCAA + Glutamine.
                   “Between working on Olympic lifts, flipping tires and doing multiple WOD’s a day, my body needs to be in recovery and repair mode all the time. The SHREDZ BCAAs are my favorite, I always have some in one of my shaker bottles to sip on throughout the day in-between coaching and training sessions.”',
                ],
                [
                   'product_id' => '6',
                   'image' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/MFW%20Toner.jpg',
                   'Link' => '(Product ID 6) Product Page',
                   'text' => 'Nikki uses Toner to push her through her workouts.
                    “I also love the Shredz Toner to help keep my endurance and energy levels high during workouts.”',
                ],
            ],
            'thumbnail' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/nikkileonard/thumbnail.jpg',
        ],
        'brandon-lomeo' => [
            'name' => 'Brandon LoMeo',
            'gender' => 'male',
            'country' => 'USA',
            'instagram_handle' => 'brandonmichaelfit',
            'hero' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/brandonlomeo/hero.jpg',
            'aboutleft' => 'Brandon was Born in California and raised in New Jersey. He has been an active personal trainer, national competitor, and model for over 15 years. In 2015 he moved back to the fitness capital of the world and has continued motivate his ever-growing fans. He overcame a lot of adversity growing up, coming from humble beginnings and giving himself purpose through his bodybuilding career.',
            'aboutright' => 'Brandon is the kind of person that lights up a room. He has a big personality and is generous with his knowledge and time. Brandon began his career in fitness as a bodybuilder and then transitioned to men’s Physique. His experience spans a decade and advocates developing a love for the process rather than the result.',
            'workout_images' => [
                'image1' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/brandonlomeo/workout_image1.jpg',
                'image2' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/brandonlomeo/workout_image2.jpg',
                'image3' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/brandonlomeo/workout_image3.jpg',
                'image4' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/brandonlomeo/workout_image4.jpg',
            ],
            'quote' => 'You determine your own success. What you sow now, you harvest later.',
            'video' => 'https://www.youtube.com/embed/DiQpbzVkMhI',
            'recommended' => [
                [
                    'product_id' => '542',
                    'image' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/CORE%20Burner%20Max.jpg',
                    'Link' => '(Product ID 542) Product Page',
                    'text' => 'Brandon’s favorite Shredz product is BurnerMax.
                    “I take BurnerMax every day before cardio, whether I’m in the off-season or if I’m prepping for a photo shoot or contest. I love how well my body responds to it with a clean diet and consistent cardio.”',
                ],
                [
                    'product_id' => '76',
                    'image' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/CORE%20BCAA.jpg',
                    'Link' => '(Product ID 76) Product Page',
                    'text' => 'Brandon is known for his abs, arms, and his pronounced muscle shape. He attributes BCAAs and Protein intake to that look.
                    “I use lots of training and diet styles to stay lean and continue building muscle and BCAA+Glutamine is a staple in my diet year ‘round.”',
                ],
            ],
            'thumbnail' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/brandonlomeo/thumbnail.jpg',
        ],
        'brittany-coutu' => [
            'name' => 'Brittany Coutu',
            'gender' => 'female',
            'country' => 'USA',
            'instagram_handle' => 'brittanycoutu',
            'hero' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/brittanycoutu/hero.jpg',
            'aboutleft' => 'WBFF Pro, gymnast and SHREDZ Athlete, Brittany Coutu is the definition of fit! Placing second in the WBFF Worlds in 2014 and being crowned Miss New England 2014, Brittany has dedicated her life to health and fitness. Splitting her time between CT and NJ, Brittany always finds time for her family, who has had such a big influence on her fitness career. After graduating high school, Brittany went on to compete in the NCAA Gymnastics Collegiate World.',
            'aboutright' => 'After college, Brittany focused on changing her lifestyle, placing importance on eating a proper diet and lifting weights to sculpt her body. Brittany’s humility, combined with her passion for achieving goals is what makes her a powerful influencer in the health industry. While she is a renowned fitness model, she loves to take time with her supporters and help others with their own fitness pursuits.',
            'workout_images' => [
                'image1' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/brittanycoutu/workout_image1.jpg',
                'image2' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/brittanycoutu/workout_image2.jpg',
                'image3' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/brittanycoutu/workout_image3.jpg',
                'image4' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/brittanycoutu/workout_image4.jpg',
            ],
            'quote' => 'If you have eyes in the front of your head, you were born to be a fearless hunter, not the timid prey.',
            'video' => 'https://www.youtube.com/embed/T-hAjQ7LdGA',
            'recommended' => [
                [
                   'product_id' => '617',
                   'image' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/Alpha%20Female.jpg',
                   'Link' => '(Product ID 617) Product Page',
                   'text' => 'Brittany loves using the Alpha Female Stack from SHREDZ.
                   “This stack has given me optimal results during prime time of my show prep. It has allowed me to build lean muscle mass while cutting body fat and allowing me to keep my curves.”',
                ],
                [
                   'product_id' => '247',
                   'image' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/MFW%20Protein.jpg',
                   'Link' => '(Product ID 247) Product Page',
                   'text' => 'Brittany uses her protein to maintain her lean curves.
                   “After a hard training session, I have to have a SHREDZ Protein shake, followed by a lean meal about 45 minutes later.”',
                ],
            ],
            'thumbnail' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/brittanycoutu/thumbnail.jpg',
        ],
        'jonathan-coyle' => [
            'name' => 'Jonathan Coyle',
            'gender' => 'male',
            'country' => 'USA',
            'instagram_handle' => 'jonathan_coyle',
            'hero' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/jonathancoyle/hero.jpg',
            'aboutleft' => 'A HYBRID Athlete, Jonathan Coyle has taken the fitness world by storm combining a relentless work ethic and passion for inspiring others in and outside of both the CrossFit Box and the Gym. Coyle uses both forms of fitness to build his ideal physique. He has one goal and one goal only, to forever destroy the current concept of what it is to be fit.',
            'aboutright' => 'His philosophy that functional movement trumps purely aesthetic oriented workouts defies the current norms of the fitness industry. His unique workouts, detailed meal plans, philosophy on life and unrelenting determination to be a catalyst for change has caused the fitness world to take notice.',
            'workout_images' => [
                'image1' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/jonathancoyle/workout_image1.jpg',
                'image2' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/jonathancoyle/workout_image2.jpg',
                'image3' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/jonathancoyle/workout_image3.jpg',
                'image4' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/jonathancoyle/workout_image4.jpg',
            ],
            'quote' => 'Everything matters, everything has consequence and every decision creates some form of momentum.',
            'video' => 'https://www.youtube.com/embed/3RwUThraNRQ',
            'recommended' => [
                [
                    'product_id' => '542',
                    'image' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/CORE%20Burner%20Max.jpg',
                    'Link' => '(Product ID 542) Product Page',
                    'text' => 'Jonathan’s favorite Shredz product is BurnerMax.
                    I take BurnerMax every day before I hit the gym early in the morning. I can feel myself performing better and leaning out every day that I take it with a clean diet.”',
                ],
                [
                    'product_id' => '4',
                    'image' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/CORE%20Detox.jpg',
                    'Link' => '(Product ID 4) Product Page',
                    'text' => 'Jonathan’s day always starts with Detox
                    Without the proper nutrients in your bloodstream, you muscles won’t function optimally. I always take Detox before I hit my morning training.',
                ],
            ],
            'thumbnail' => 'https://shredz-com-v2.s3.amazonaws.com/athletes/jonathancoyle/thumbnail.jpg',
        ],
        'erko-jun' => [
            'name' => 'Erko Jun',
            'gender'=>'male',
            'instagram_handle'=>'erkojun',
            'country' => 'BELGIUM',
            'hero'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/erkojun/hero.jpg',
            'aboutleft'=>'Erko is a personal trainer and fitness model who has been on the cover of countless magazines, has worked with internationally acclaimed photographers and makes numerous appearances at shows and events all over the world.',
            'aboutright'=>'He has grown into into a successful businessman and athlete who loves to share his knowledge with as many people as he can. Erko takes a balanced approach to his diet and training. He doesn\'t restrict himself so much that he can’t get in hard, old school training in at least 5 days a week.',
            'workout_images'=>[
            'image1'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/erkojun/workout_image1.jpg',
            'image2'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/erkojun/workout_image2.jpg',
            'image3'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/erkojun/workout_image3.jpg',
            'image4'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/erkojun/workout_image4.jpg',
            ],
            'quote'=>'If you want to live the life of your dreams you have to put in the work you never dreamed possible…you just get up and make it happen!',
            'video'=>'https://www.youtube.com/embed/30o3HKR0W4U',
            'recommended'=>[
                [
                    'product_id'=>'542',
                   'image'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/CORE%20Burner%20Max.jpg',
                   'Link'=>'(Product ID 542) Product Page',
                   'text'=>'Erko loves BURNERMAX and never hits cardio without it “If you’re going to put yourself through cardio, may as well get the most out of it. I use Burner Max every time I get ready for a shoot.”'
                ],
                [
                  'product_id'=>'11',
                   'image'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/CORE%20Protein.jpg',
                   'Link'=>'(Product ID 11) Product Page',
                    'text'=>'Erko uses SHREDZ protein to help keep him on track when dieting for shoots and recovering from hard training sessions. “I love the Cinnamon flavor, I feel like I’m cheating on my diet but really I’m building the body I’ve always worked so hard for."'
                ]
        ],
        'thumbnail'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/erkojun/thumbnail.jpg'
        ],
        'anthony-amar' => [
            'name' => 'Anthony Amar',
            'gender'=>'male',
            'instagram_handle'=>'antonao',
            'country' => 'FRANCE',
            'hero'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/anthonyamar/hero.jpg',
            'aboutleft'=>'Anthony Amar is a SHREDZ Athlete who loves spreading his passion for fitness and takes the weight room as seriously as his nutrition. When Anthony isn’t killing it in the gym, he enjoys spending time with his family and encourages them to lead a healthy life as well.',
            'aboutright'=>'Anthony takes an old school approach to training, focusing on balance and symmetry as opposed to raw size. He is known for his consistently spot-on conditioning and continues to improve himself year after year.',
            'workout_images'=>[
            'image1'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/anthonyamar/workout_image1.jpg',
            'image2'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/anthonyamar/workout_image2.jpg',
            'image3'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/anthonyamar/workout_image3.jpg',
            'image4'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/anthonyamar/workout_image4.jpg',
            ],
            'quote'=>'I push myself to the max because that’s all I know how to do.',
            'video'=>'https://www.youtube.com/embed/DD2xke2EyBE',
            'recommended'=>[
                [
                'product_id'=>'2',
                'image'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/CORE%20Creatine.jpg',
                'Link'=> '(Product ID 2) Product Page',
                'text'=>'SHREDZ Creatine is a must-have product that Anthony uses to help keep his shredded physique on point all year round. “I love to get the most out of my workouts and with the SHREDZ Creatine I know my muscle recovery and workouts are always top notch.”'
                ],
                [
                   'product_id'=>'76',
                   'image'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/Featured%20Products/CORE%20BCAA.jpg',
                   'Link'=>'(Product ID 76) Product Page',
                    'text'=>'SHREDZ BCAA + Glutamine is a staple in Anthony\'s Supplementation program “The beauty of this sport is that you are forcing fat loss while building muscle, which is against your body’s natural tendency. BCAAs are essential for keeping in this kind of condition.”'
                ]
            ],
            'thumbnail'=>'https://shredz-com-v2.s3.amazonaws.com/athletes/anthonyamar/thumbnail.jpg'
        ]
    ];

    /**
     * @var array
     */
    protected $ambassadors = [
        'dolly-castro' => [
            'name' => 'Dolly Castro',
            'gender' => 'female',
            'hero' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
            'aboutleft' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'aboutright' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'workout_images' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
            'quote' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'video' => 'video.mp4',
            'recommended' => [
                'product' => [
                    'image' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
                    'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
                ],
                'product2' => [
                    'image' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
                    'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
                ],
            ],
            'thumbnail' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
        ],
        'cally-breaux' => [
            'name' => 'Cally Breaux',
            'gender' => 'female',
            'hero' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
            'aboutleft' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'aboutright' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'workout_images' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
            'quote' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'video' => 'video.mp4',
            'recommended' => [
                'product' => [
                    'image' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
                    'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
                ],
                'product2' => [
                    'image' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
                    'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
                ],
            ],
            'thumbnail' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
        ],
        'chantel-zales' => [
            'name' => 'Chantel Zales',
            'gender' => 'female',
            'hero' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
            'aboutleft' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'aboutright' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'workout_images' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
            'quote' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'video' => 'video.mp4',
            'recommended' => [
                'product' => [
                    'image' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
                    'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
                ],
                'product2' => [
                    'image' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
                    'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
                ],
            ],
            'thumbnail' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
        ],
        'pamela-reif' => [
            'name' => 'Pamela Reif',
            'gender' => 'female',
            'hero' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
            'aboutleft' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'aboutright' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'workout_images' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
            'quote' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'video' => 'video.mp4',
            'recommended' => [
                'product' => [
                    'image' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
                    'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
                ],
                'product2' => [
                    'image' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
                    'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
                ],
            ],
            'thumbnail' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
        ],
        'laci-kay' => [
            'name' => 'Lazy Kay',
            'gender' => 'female',
            'hero' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
            'aboutleft' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'aboutright' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'workout_images' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
            'quote' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'video' => 'video.mp4',
            'recommended' => [
                'product' => [
                    'image' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
                    'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
                ],
                'product2' => [
                    'image' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
                    'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
                ],
            ],
            'thumbnail' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
        ],
        'ellie-gonsalves' => [
            'name' => 'Ellie Gonsalves',
            'gender' => 'female',
            'hero' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
            'aboutleft' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'aboutright' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'workout_images' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
            'quote' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'video' => 'video.mp4',
            'recommended' => [
                'product' => [
                    'image' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
                    'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
                ],
                'product2' => [
                    'image' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
                    'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
                ],
            ],
            'thumbnail' => 'https://images.bwwstatic.com/columnpic6/B37B2DF3-CE3F-722D-A31C272495BA3D81.jpg',
        ],
    ];

    /**
     * @param $page
     *
     * @return array
     */
    public function getAthlete($page)
    {
        if (isset($this->athletes[$page])) {
            return $this->athletes[$page];
        } else {
            return [];
        }
    }

    /**
     * @param $page
     *
     * @return array
     */
    public function getAmbassador($page)
    {
        if (isset($this->ambassadors[$page])) {
            return $this->ambassadors[$page];
        } else {
            return [];
        }
    }

    /**
     * @param null $gender
     *
     * @return array|static
     */
    public function getAthletes($gender = null)
    {
        if (!$gender) {
            return $this->athletes;
        }
        $collection = Collection::make($this->athletes);

        return $collection->where('gender', $gender);
    }

    /**
     * @param null $gender
     *
     * @return array|static
     */
    public function getAmbassadors($gender = null)
    {
        if (!$gender) {
            return $this->ambassadors;
        }
        $collection = Collection::make($this->ambassadors);

        return $collection->where('gender', $gender);
    }
}
