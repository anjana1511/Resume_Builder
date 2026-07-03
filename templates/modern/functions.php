<?php

/* ==========================================================
   MODERN TEMPLATE FUNCTIONS
   ========================================================== */
$skillStyles = [

    'modern1' => 'stars',
    'modern2' => 'bars',
    'modern3' => 'vline',
    'modern4' => 'progress',
    'minimal' => 'ignpost',
    'creative2' => 'check',

];
$languageStyles = [

    'modern1' => 'progress',
    'modern2' => 'progress',
    'modern3' => 'stars',     // circile
    'minimal' => 'progress',
    'creative1' => 'text',
    'modern4' => 'arrow', 

];
$interestStyles = [

    'modern1' => 'tags',
    'modern2' => 'icons',
    'creative1' => 'bullet',

];
/*   hobbies  */
function renderInterest($hobbies)
{
    $hobbies = explode(",", $hobbies);

    foreach ($hobbies as $hobby) {
        echo '<span class="hobby-tag">' . htmlspecialchars(trim($hobby)) . '</span>';
    }
}



/*-----------------------------------------------------------
| Skills : Percentage -> Stars
| Database : 90,80,70...
------------------------------------------------------------*/

function renderSkill($skill,$level,$template)
{
    global $skillStyles;
    $style = $skillStyles[$template] ?? 'text';
    switch($style)
    {
        case "stars":
            return  '<span class="skill-item">'.$skill.'</span>'
                     .renderSkillStars($level);         
            break;

        case "progress":
            return   '<span class="skill-item">'.$skill.'</span>'
                       .renderSkillProgress($level);
            break;

        case "tags":
             return  '<span class="skill-item">'.$skill.'</span>';
                      
             break;

        case "bars":
             return  '<div class="skill-row"><span class="skill-item">'.$skill.'</span>'
                      .renderSkillBars($level).
                      '</div>';
             break;
        case "ignpost":
            return '<i class="bi bi-signpost-fill"></i><span class="skill-item">'.$skill.'</span>';
            break;
        
        case "vline":
            return '<div class="skill-vline"><span>'.$skill.'</span></div>';
            break;
            
        default:
             return  '<span class="skill-item">'.$skill.'</span>';

            
    }
}


/*-----------------------------------------------------------
| Languages : Beginner -> Progress Bar
------------------------------------------------------------*/

function renderLanguage($lang,$level,$template)
{

    global $languageStyles;
    $style = $languageStyles[$template] ?? 'text';
    switch($style)
    {
        case "stars":
            return  '<span class="language-item">'.$lang.'</span>'
                     .renderLanguageStars($level);         
            break;

        case "progress":
            return   '<span class="language-item">'.$lang.'</span>'
                       .renderLanguageProgress($level);
            break;

        case "arrow":
             return  '<div class="language-item"><i class="bi bi-arrow-right-short"></i>'.$lang.'</div>';
                      
             break;

        case "bars":
             return  '<div class="skill-row"><span class="language-item">'.$lang.'</span>'
                      .renderSkillBars($level).
                      '</div>';
             break;
        case "check":
            return '<i class="bi bi-check-circle-fill"></i>'.$lang;
            break;
        default:
             return  '<span class="language-item">'.$lang.'</span>';

            
    }


}
function renderLanguageProgress($level){


    switch(strtolower($level))
    {

        case "advanced":
            $width = 100;
        break;

        case "intermediate":
            $width = 70;
        break;

        case "beginner":
            $width = 40;
        break;

        default:
            $width = 20;

    }

    return '
        <div class="language-progress">

            <div class="language-progress-fill"
                 style="width:'.$width.'%"></div>

        </div>
    ';
}
function renderLanguageStars($level){

$level = strtolower(trim($level));

   if ($level == 'native') {
                        $stars = 5;
                    } elseif ($level == 'advanced') {
                        $stars = 4;
                    } elseif ($level == 'intermediate') {
                        $stars = 3;
                    } elseif ($level == 'beginner') {
                        $stars = 2;
                    } else {
                        $stars = 1;
                    }

                    $html = '<div class="language-circle">';

                    for ($i = 1; $i <= 5; $i++) {

                        if ($i <= $stars) {

                            $html .= '<i class="bi bi-circle-fill active"></i>';

                        } else {

                            $html .= '<i class="bi bi-regular bi-circle"></i>';

                        }

                    }

                     $html .= '</div>';

    return $html;

}

function renderSkillStars($level){

   if ($level >= 90) {
                        $stars = 5;
                    } elseif ($level >= 75) {
                        $stars = 4;
                    } elseif ($level >= 60) {
                        $stars = 3;
                    } elseif ($level >= 40) {
                        $stars = 2;
                    } else {
                        $stars = 1;
                    }

                    $html = '<div class="skill-stars">';

                    for ($i = 1; $i <= 5; $i++) {

                        if ($i <= $stars) {

                            $html .= '<i class="bi bi-star-fill active"></i>';

                        } else {

                            $html .= '<i class="bi bi-regular bi-star"></i>';

                        }

                    }

                     $html .= '</div>';

    return $html;

}
function renderSkillProgress($level)
{

return '<div class="skill-progress">
                <span class="skill-progress-fill" style="width:'.$level.'%;"></span>
            </div>';
}

function renderSkillTags($skill)
{
return '<span class="skill-item">'.$skill.'</span>';

}

function renderSkillBars($level)
{
    if ($level >= 90) {
        $bars = 5;
    } elseif ($level >= 75) {
        $bars = 4;
    } elseif ($level >= 60) {
        $bars = 3;
    } elseif ($level >= 40) {
        $bars = 2;
    } else {
        $bars = 1;
    }

    $html = '<div class="vertical-rating">';

    for($i = 1; $i <= 5; $i++)
    {
        if($i <= $bars)
        {
            $html .= '<span class="fill"></span>';
        }
        else
        {
            $html .= '<span></span>';
        }
    }

    $html .= '</div>';

    return $html;
}