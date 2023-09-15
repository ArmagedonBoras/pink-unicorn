<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create(['name' => 'Info', 'link' => 'info', 'sort_order' => 10, 'gate' => 'user']);
        Menu::create(['name' => 'User', 'link' => 'user', 'sort_order' => 10, 'gate' => 'hidden']);
        Menu::create(['name' => 'Bokning', 'link' => 'bookings', 'sort_order' => 30, 'gate' => 'user']);
        // Menu::create(['name' => 'Bli medlem', 'link' => 'bli-medlem', 'sort_order' => 40, 'gate' => 'guest', 'parent' =>"medlemskap" ]);

        $membershipPage = Page::create([
            'title' => 'Om Medlemskap',
            'body' => '<p><strong>Gå med</strong><br />',
            'active' => 1,
            'title_image' => 'storage/bg-images/title-bg-2.jpg',
        ]);
        if (App::environment() == 'production') {
            $membershipMenu = Menu::create(['name' => 'Om Medlemskap', 'link' => 'medlemskap', 'sort_order' => 30, 'page_id' => $membershipPage->id, 'gate' => 'guest']);
            $membershipMenu = Menu::create(['name' => 'Medlemskap', 'link' => 'medlemskap', 'sort_order' => 30, 'gate' => 'user']);
        } else {
            $membershipMenu = Menu::create(['name' => 'Medlemskap', 'link' => 'medlemskap', 'sort_order' => 30,]);
            $membershipMenu = Menu::create(['name' => 'Om Medlemskap', 'link' => 'medlemskap', 'sort_order' => 30, 'parent' => 'medlemskap', 'page_id' => $membershipPage->id]);
            $memberlistMenu = Menu::create(['name' => 'Bokningsläget', 'link' => 'bokningslaget', 'sort_order' => 40, 'parent' => 'medlemskap', 'gate' => 'guest']);
        }
        $memberlistMenu = Menu::create(['name' => 'Mitt medlemskap', 'link' => 'mitt', 'sort_order' => 40, 'parent' => 'medlemskap', 'gate' => 'user']);
        $memberlistMenu = Menu::create(['name' => 'Prisräknare', 'link' => 'bokningspris', 'sort_order' => 50, 'parent' => 'medlemskap',]);
        $memberlistMenu = Menu::create(['name' => 'Medlemslista', 'link' => 'medlemslista', 'sort_order' => 30, 'parent' => 'medlemskap', 'gate' => 'user']);
        $memberlistMenu = Menu::create(['name' => 'Filarkiv', 'link' => 'filarkiv', 'sort_order' => 40, 'parent' => 'medlemskap', 'gate' => 'user']);

        $aboutMenu = Menu::create(['name' => 'Om oss', 'link' => 'om', 'sort_order' => 50]);
        $aboutPage = Page::create([
            'title' => 'Om oss',
            'body' => '<p>Karlstads bilkooperativ har funnits sedan 1999 och är ett av Sveriges första bilkooperativ. '.
                        'Vi är en ekonomisk förening som drivs utan vinstintresse och leds av en styrelse. Det praktiska arbetet med bilarna leds av en bilvårdsansvarig. '.
                        'Årsmöte hålls i slutet av mars och där ser vi gärna så många medlemmar som möjligt.</p><br>'.
                        '<p>Du är välkommen att höra av dig med frågor på adressen <a href="mailto:medlemskap@karlstadsbilkooperativ.org">medlemskap@karlstadsbilkooperativ.org</a>.</p>',
            'active' => 1,
            'title_size' => 400,
            'title_image' => 'storage/bg-images/title-bg-2.jpg',
        ]);
        $aboutPage->menu()->save($aboutMenu);

        $ideaMenu = Menu::create(['name' => 'Hem', 'link' => 'armagedon', 'sort_order' => 10]);
        $ideaPage = Page::create([
            'title' => 'Armagedon',
            'title_color' => '#000000',
            'tagline' => 'Kul att du hittat hit!',
            'tagline_color' => '#000000',
            'body' =>
                '<p>Om du är nyfiken på oss är det en bra start att läsa igenom följande.</p>

                <p>Armagedon är en ideell förening. En förening är en grupp människor som vill göra något tillsammans. Vi är anslutna till SVEROK och du kan läsa mer om dem samt ideella föreningar
                <a href="http://www.sverok.se/sverok/">här</a>!</p>

                <p>Vi har inte någon anställd som ansvarar för våra lokaler eller anordnar våra aktiviteter. Vi tar själva tillsammans hand om våra lokaler och våra speldagar/kvällar arrangeras av våra egna medlemmar.</p>


                <strong>Det innebär att vi har</strong>
                <ul>
                    <li>öppna aktiviteter som alla kan delta i men också aktiviteter för bara ett fåtal deltagare.</li>
                    <li>aktiviteter som är enkla att prova på men även sådana som kräver mer förberedelser.</li>
                    <li>gratis aktiviteter som inte kostar någonting och andra där du kan behöva köpa egna tillbehör & figurer.</li>
                </ul>

                <strong>Det betyder också att vi</strong>
                <ul>
                    <li>hjälps åt med att städa och hålla ordning.</li>
                    <li>respekterar föreningens och andra medlemmars ägodelar.</li>
                    <li>kanske inte kan erbjuda alla precis det de vill göra.</li>
                </ul>

                <strong>Vet du inte riktigt vad du vill spela/göra/testa på?</strong>
                <ul>
                    <li>Läs mer om alla slags spel som finns på SVEROKs hemsida här!</li>
                    <li>Prata med oss. Kanske har vi redan en grupp som du kan gå med i?</li>
                    <li>Prata med några vänner, prata sedan med oss - då kan vi hjälpa er komma igång!</li>
                </ul>
                Armagedons Regelbok finns tillgänglig i .pdf för nedladdning här
                <br><br>
                Välkommen till Armagedon!',
            'active' => 1,
            'title_image' => 'storage/bg-images/Hero_test-1-1000x500.jpg',
            'title_size' => 100,
        ]);
        $ideaPage->menu()->save($ideaMenu);

        $placeMenu = Menu::create(['name' => 'Lokalen', 'link' => 'lokalen', 'sort_order' => 20]);
        $placePage = Page::create([
            'title' => 'Lokalen',
            'body' =>
                    '<p>Välkommen till oss! Här är vår adress:<br>
                    Armagedon<br>
                    Katrinehillsgatan 7b<br>
                    504 52 Borås<br><br>

                    Vi arbetar på en bättre presentation av våra lokaler. För dig som tänkt besöka oss kan det vara värt att veta att vi tyvärr inte har handikappanpassad entré. Det är trapporna en våning upp som gäller.</div>',
            'active' => 1,
            'title_image' => 'storage/bg-images/title-bg-2.jpg',
            'title_size' => 200,
        ]);

        $placePage->menu()->save($placeMenu);

        Menu::create(['name' => 'Admin', 'link' => 'admin', 'sort_order' => 200, 'gate' => 'admin']);
        Menu::create(['name' => 'Rättigheter', 'link' => 'permissions', 'sort_order' => 10, 'parent' => 'admin']);
        Menu::create(['name' => 'Roller', 'link' => 'roles', 'sort_order' => 20, 'parent' => 'admin']);
        Menu::create(['name' => 'Taggar/listposter', 'link' => 'tags', 'sort_order' => 50, 'parent' => 'admin']);
        Menu::create(['name' => 'Statiska sidor', 'link' => 'pages', 'sort_order' => 60, 'parent' => 'admin']);
        Menu::create(['name' => 'Medlemmar', 'link' => 'members', 'sort_order' => 70, 'parent' => 'admin']);
        Menu::create(['name' => 'Körjournal', 'link' => 'journals', 'sort_order' => 80, 'parent' => 'admin']);
        Menu::create(['name' => 'Menyer', 'link' => 'menus', 'sort_order' => 90, 'parent' => 'admin']);
        Menu::create(['name' => 'Inställningar', 'link' => 'settings', 'sort_order' => 100, 'parent' => 'admin']);
    }
}
