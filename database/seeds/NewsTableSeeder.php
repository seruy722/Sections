<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = range(1, 18);
        shuffle($arr);
        foreach ($arr as $val) {
            DB::table('news')->insert([
                [
                    'title' => 'Кружки и секции: направляем развитие ребенка',
                    'description' => 'Оглядываясь назад, осознала, что накоплен тринадцатилетний опыт посещения моими 
                детьми досуговых центров. В какие кружки, секции отдавать ребенка? С какого возраста? Чем при этом 
                руководствоваться? Какие занятия выбирать, платные - бесплатные? Учитывать ли отдаленность от дома?',
                    'content' => '<h5>Побудительные причины</h5>
                Как только понимала, что моему ребенку необходимы те или иные навыки, а сама я не могла им научить, 
                я искала подходящие занятия или нужного преподавателя. Так получилось с первыми нашими уроками вне 
                стен дома. Сын выучил алфавит, мог складывать буквы в слоги, но не мог научиться, к двум буквам 
                присоединять третью. Занятия у частного логопеда смогли решить эту проблему. В это же время, в четыре 
                года я отдала его в хор, так как были серьезные проблемы с речью. Хоровое пение, я надеялась, научит 
                четко слышать и тянуть каждый звук.<br>
                <h5>Присутствие на занятиях</h5>
                До школы были индивидуальные занятия у бесплатного и платного логопеда. Уровень преподавания сильно 
                разнился. Поэтому, если вы хотите явного результата, то придется раскошеливаться. Обязательным условием 
                качественных занятий является ваше присутствие на уроке. Тогда преподаватель работает на «полную катушку» 
                и вы при закреплении материала дома четко понимаете, о чем идет речь и какой должен быть результат.<br>
                <h5>Всему свое время</h5>
                Для разностороннего развития я водила четырехлетнего сына в бассейн. Сейчас он немногословно вспоминает 
                то время: «Было тесно и скучно. Я не понимал, зачем руки надо класть на воду так, а ногами работать вот 
                этак. Мне было неудобно так двигаться в воде. Я не понимал, чтобы научиться быстро плавать, нужно 
                «поставить» определенные движения». В двенадцать лет он снова, но уже самостоятельно и с большим 
                удовольствием стал посещать бассейн. Три года тренировок сколиоз не выправили, но в глаза бросается 
                широкий разворот плеч и красивые уверенные «поставленные» движения тела, когда он оказывается в воде. 
                На суше прежняя скованность, закомплексованность.<br>
                Вашему ребенку крупно повезет, если в его жизни встретится такой преподаватель. Природную скромность, 
                можно сказать, болезненную зажатость, я пыталась выправить в районном доме творчества, в театральном 
                кружке. «Отдавала» ребенка конкретному преподавателю. Сыну она показала, что такое декламация, 
                художественное чтение, интонация, настроение стихотворения, ритм и рифма. И когда в школе задавали 
                стих наизусть, он уже сам шел к ней и она ему «ставила» чтение с выражением. Когда я видела любимого 
                отпрыска в спектаклях, я плакала, потому что это был не мой сын. Как он «гулял» интонацией и голосом, 
                какие шикарные широкие жесты были, как свободно и красиво он двигался по сцене, а какое перевоплощение! 
                Он наслаждался игрой, а я наслаждалась им! Но это было, как с бассейном. В миру он оставался прежним 
                закомплексованным и зажатым мальчиком. Он не смог перенести приобретенные навыки в повседневную жизнь.
                Так как состоялся продуктивный диалог с преподавателем театральной студии, которая еще вела и кружок 
                росписи, мой сын много лет занимался у нее рисованием, расписывал доски и различные деревянные поделки. 
                В результате вся дача завешена, заставлена красивыми почти профессионально выполненными работами. 
                Но, к сожалению, сын так и не стал творческой натурой, у него нет стремления, что-то создать и 
                облагородить<br>',
                    'image_name' => 'img.jpg',
                    'section_id' => $val,
                    'active' => true
                ],
                [
                    'title' => 'Быстрее, выше, сильнее: как правильно выбрать секцию для ребенка',
                    'description' => 'Все родители хотят вырастить свое чадо крепким и здоровым. Известно, что 
                    физические нагрузки как нельзя лучше закаляют характер. Поэтому пришло время задуматься над тем, 
                    какой из множества видов спорта предпочесть.',
                    'content' => '<h5>КОГДА НАЧИНАТЬ?</h5>
                Вы сами решаете готов ребенок к нагрузкам или нет. И хотя одержимые спортивными достижениями тренеры 
                могут сказать вам: «Чем раньше начать занятия, тем лучше», — не спешите. Дайте ребенку набраться сил. 
                Ведь чрезмерно большие нагрузки могут негативно сказаться на физическом и психологическом развитии 
                малыша. Например, завышенные требования могут спровоцировать синдром хронической усталости, нервные 
                срывы и конфликты со взрослыми. Исключение существует для тех, кто выбирает фигурное катание, 
                спортивную или художественную гимнастику — там, чтобы добиться успехов, действительно требуется 
                раннее начало.<br>
                Футбол, хоккей, спортивная и художественная гимнастика, теннис, единоборства в одинаковой степени 
                хороши для развития таких качеств, как выносливость, координация, быстрота реакции, сила воли, 
                бойцовский характер. Но, откровенно говоря, занятия практически любым видом спорта дают такой эффект
                 — превращают ребенка в сильную, пусть пока и маленькую, личность. Поэтому тренеры каждой секции 
                 особо отмечают качества своего вида спорта. Например, футбол, баскетбол, волейбол и хоккей помогают 
                 социальной адаптации трудных детей среди их более благополучных сверстников, а умение разумно 
                 распределять нагрузки, экономить силы научит вчерашних непосед управлять эмоциями и принимать 
                 взвешенные решения. Тренеры-теннисисты говорят, что их вид спорта развивает молниеносную реакцию и 
                 формирует со временем атлетически подтянутую фигуру. Так что перед родителями стоит довольно 
                 непростой выбор. Секций много, и все обещают высокие достижения.<br>
                <h5>КАК СОВЕРШИТЬ ПРАВИЛЬНЫЙ ВЫБОР?</h5>
                Не стоит вести малыша в секцию по принципу «туда же, куда отдали друзья, знакомые, соседи, — чтобы не 
                было скучно». Для начала оцените социальный характер вашего ребенка — как он ладит с другими детьми, 
                готов ли добиваться результатов и разделить радость победы со сверстниками. Любые командные виды 
                спорта лучше всего подойдут ребятишкам, у которых развиты навыки общения. Так что если у вашего сына 
                или дочери много друзей и они легко заводят знакомства, то игра в команде, где победа достигается 
                усилиями всех участников, укрепит коммуникабельность детей и обеспечит их социальную устойчивость во 
                взрослой жизни. Если же ребенок — выраженный лидер и не готов «делиться победой» с другими 
                участниками, подойдет спортивная или художественная гимнастика, большой или настольный теннис. 
                Все эти виды спорта требуют личных усилий маленького человечка. А родители могут акцентировать 
                лидерские качества сына или дочери, закалить силу воли и воспитать целеустремленность, дав понять 
                ребенку, что лишь от его усердия и готовности тренироваться не только на занятиях, но и дома зависит 
                будущий успех.<br>
                В этом смысле даже групповые упражнения в художественной гимнастике или парное фигурное катание и 
                спортивные бальные танцы, где результат зависит и от партнера, все равно по своей специфике делают 
                ставку на личные усилия спортсмена. В частности, на его артистизм и умение преподнести себя публике и
                 жюри. Не менее важную роль при выборе секции играет темперамент. Гиперактивным детям, драчунам и 
                 задирам помогут выплеснуть чрезмерную энергию и заодно избавиться от агрессии секции единоборств. 
                 Бои по строгим правилам и этика уважительного отношения к бойцу-сопернику позволят мальчишкам и 
                 девчонкам (а в секции единоборств их приходит все больше!) в будущем сознательно отказаться от 
                 уличных жестоких развлечений без правил. Детям застенчивым, тихоням и замкнутым в командные игры, 
                 особенно в хоккей с его жесткими правилами игры, идти не стоит. Иначе ребенок может замкнуться среди 
                 «боевых» сверстников. Единоборства, где требуется «спортивная злость», или виды спорта с ярко 
                 выраженными чертами индивидуального успеха, лидерства таким ребятам тоже не подойдут. Для ранимых и 
                 тонко чувствующих натур оптимальны индивидуальные занятия. На первом месте в этом случае плавание и 
                 конный спорт. Бассейн и верховая езда хороши и для проблемных детей, с чересчур резкими 
                 эмоциональными реакциями, чья повышенная возбудимость и гиперактивность вызваны неврологическими 
                 трудностями. Вода, как и общение с лошадьми, успокаивает и одновременно раскрепощает маленького 
                 спортсмена, дает ребенку чувство комфорта, снимает стресс. А правильная осанка и гармоничное 
                 развитие всех групп мышц служат оздоровлению основных систем организма. Например, конный спорт врачи 
                 даже рекомендуют как возможность излечить ДЦП.<br>',
                    'image_name' => 'keggg.png',
                    'section_id' => $val,
                    'active' => true
                ],
            ]);
        }
    }
}