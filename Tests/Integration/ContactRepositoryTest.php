<?php namespace Modules\Contact\Tests\Integration;

use Faker\Factory;
use Illuminate\Support\Facades\App;
use Modules\Contact\Facades\ContactFacade as Contact;

class ContactRepositoryTest extends BaseContactTest
{
    /** @test */
    public function it_creates_contacts()
    {
        $contact = $this->contact->create(['name' => 'testContact', 'en' => ['body' => 'lorem en'], 'fr' => ['body' => 'lorem fr']]);
        $contacts = $this->contact->all();

        $this->assertCount(1, $contacts);
        $this->assertEquals('testcontact', $contact->name);
        $this->assertEquals('lorem en', $contact->translate('en')->body);
        $this->assertEquals('lorem fr', $contact->translate('fr')->body);
    }

    /** @test */
    public function it_gets_only_online_contacts()
    {
        $this->createRandomContact();
        $this->createRandomContact(true, true);
        $this->createRandomContact(true, true);
        $this->createRandomContact(true, false);

        $allContacts = $this->contact->all();
        $onlineContactsFr = $this->contact->allOnlineInLang('fr');
        $onlineContactsEn = $this->contact->allOnlineInLang('en');

        $this->assertCount(4, $allContacts);
        $this->assertCount(2, $onlineContactsFr);
        $this->assertCount(3, $onlineContactsEn);
    }

    /** @test */
    public function it_gets_contact_by_name()
    {
        $this->contact->create(['name' => 'testcontact', 'en' => ['body' => 'lorem en', 'online' => true], 'fr' => ['body' => 'lorem fr', 'online' => true]]);
        $this->createRandomContact(true, true);
        $this->createRandomContact(true, true);
        $this->createRandomContact(true, true);

        $contact = $this->contact->get('testcontact');

        $this->assertEquals('lorem en', $contact);
    }

    /** @test */
    public function it_gets_contact_by_name_if_online()
    {
        $this->contact->create(['name' => 'testContact', 'en' => ['body' => 'lorem en', 'online' => true], 'fr' => ['body' => 'lorem fr', 'online' => false]]);
        $this->createRandomContact(true, true);
        $this->createRandomContact(true, true);
        $this->createRandomContact(true, true);

        App::setLocale('fr');
        $contact = $this->contact->get('testContact');
        $this->assertEquals('', $contact);

        App::setLocale('en');
        $contact = $this->contact->get('testcontact');
        $this->assertEquals('lorem en', $contact);
    }

    /** @test */
    public function it_gets_contact_by_facade()
    {
        $this->contact->create(['name' => 'testcontact', 'en' => ['body' => 'lorem en', 'online' => true], 'fr' => ['body' => 'lorem fr', 'online' => false]]);
        $this->createRandomContact(true, true);
        $this->createRandomContact(true, true);

        $contact = Contact::get('testcontact');

        $this->assertEquals('lorem en', $contact);
    }

    /** @test */
    public function it_slugifies_the_name_property()
    {
        $contact = $this->contact->create(['name' => 'test contact', 'en' => ['body' => 'lorem en', 'online' => true], 'fr' => ['body' => 'lorem fr', 'online' => false]]);

        $this->assertEquals('test-contact', $contact->name);
    }

    public function it_makes_name_unique()
    {
        $this->contact->create(['name' => 'test contact']);
        $contact = $this->contact->create(['name' => 'test contact']);

        $this->assertEquals('test-contact-1', $contact->name);
    }

    /** @test */
    public function it_increments_name_if_not_unique()
    {
        $this->contact->create(['name' => 'test contact']);
        $this->contact->create(['name' => 'test contact']);
        $contact1 = $this->contact->create(['name' => 'test contact']);
        $contact2 = $this->contact->create(['name' => 'test contact']);

        $this->assertEquals('test-contact-2', $contact1->name);
        $this->assertEquals('test-contact-3', $contact2->name);
    }

    /** @test */
    public function it_updates_contact_without_name_change()
    {
        $contact = $this->contact->create(['name' => 'test contact']);
        $this->contact->update($contact, ['name' => 'test-contact']);

        $this->assertEquals($contact->name, 'test-contact');
    }

    /** @test */
    public function it_updates_contact_with_name_change()
    {
        $contact = $this->contact->create(['name' => 'test contact']);
        $this->contact->update($contact, ['name' => 'my awesome contact']);

        $this->assertEquals($contact->name, 'my-awesome-contact');
    }

    /** @test */
    public function it_returns_empty_string_if_contact_doesnt_exist()
    {
        $contact = $this->contact->get('heya');

        $this->assertSame('', $contact);
    }

    /**
     * Create a contact with random properties
     * @param bool $statusEn
     * @param bool $statusFr
     * @return mixed
     */
    private function createRandomContact($statusEn = false, $statusFr = false)
    {
        $factory = Factory::create();

        $data = [
            'name' => $factory->word,
            'en' => [
                'body' => $factory->text,
                'online' => $statusEn,
            ],
            'fr' => [
                'body' => $factory->text,
                'online' => $statusFr,
            ],
        ];

        return $this->contact->create($data);
    }
}
