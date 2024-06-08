<?php

include "./connection.php";

function validateToken($token) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE api_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

// Function to generate random data
function generateRandomData($count = 1, $countryFilter = null, $cityFilter = null) {

    $names = [
        'Ravi', 'Suresh', 'Priya', 'Neha', 'Rahul', 'Deepak', 'Anjali', 'Rajesh', 'Asha', 'Vijay',
        'Ahmed', 'Fatima', 'Ali', 'Ayesha', 'Imran', 'Zoya', 'Mohammad', 'Sana', 'Bilal', 'Sadia',
        'Aminul', 'Farhana', 'Rahim', 'Nusrat', 'Jamil', 'Tasnim', 'Mizan', 'Nazia', 'Arif', 'Munira',
        'Dinesh', 'Malini', 'Saman', 'Pooja', 'Chaminda', 'Aruna', 'Nalini', 'Asanka', 'Rashmi', 'Sudesh',
        'Suresh', 'Gita', 'Bibek', 'Sunita', 'Ramesh', 'Sarita', 'Dipesh', 'Anita', 'Rajendra', 'Nisha',
        'Tashi', 'Dawa', 'Karma', 'Sonam', 'Chencho', 'Pema', 'Dorji', 'Tshering', 'Kinzang', 'Ugyen',
        'Mohamed', 'Aisha', 'Ahmed', 'Fathimath', 'Ibrahim', 'Mariyam', 'Ali', 'Zaina', 'Hassan', 'Sara', 'Shahabas',
        'Budi', 'Siti', 'Agus', 'Dewi', 'Hadi', 'Rini', 'Joko', 'Yuni', 'Hendra', 'Ratna',
        'Ahmad', 'Siti', 'Muhammad', 'Nor', 'Abdullah', 'Aminah', 'Hassan', 'Zainab', 'Hafiz', 'Rozita',
        'Juan', 'Maria', 'Jose', 'Luz', 'Pedro', 'Rosa', 'Miguel', 'Nena', 'Emilio', 'Carmen',
        'Wei', 'Yan', 'Jia', 'Kok', 'Hui', 'Seng', 'Li', 'Cheng', 'Lian', 'Ming',
        'Somsak', 'Somchai', 'Nonglak', 'Naree', 'Chai', 'Kanya', 'Sompong', 'Anong', 'Prasert', 'Siri',
        'Hoa', 'Thao', 'Dung', 'Lan', 'Quan', 'Trang', 'Minh', 'Hien', 'Tuan', 'Anh',
        'Wei', 'Li', 'Zhang', 'Wang', 'Chen', 'Liu', 'Yang', 'Huang', 'Xu', 'Lin',
        'Haruto', 'Yui', 'Ren', 'Aoi', 'Hiroto', 'Sakura', 'Yuto', 'Akari', 'Riku', 'Koharu',
        'Minho', 'Soojin', 'Hyeon', 'Yuna', 'Joon', 'Soyoung', 'Jinwoo', 'Hana', 'Dongha', 'Eunji',
        'Ji-hoon', 'Eun-hee', 'Min-joon', 'Kyung-soo', 'Ji-yeon', 'Sung-hoon', 'Hye-jin', 'Dae-hyun', 'Mi-sook', 'Seok-jin',
        'Bat', 'Tuya', 'Baatarkhuu', 'Uyanga', 'Naran', 'Erdene', 'Oyun', 'Ganbat', 'Tsatsral', 'Enkhjin',
        'Ivan', 'Svetlana', 'Dmitry', 'Olga', 'Vladimir', 'Natalia', 'Sergei', 'Yulia', 'Andrei', 'Elena',
        'James', 'William', 'Charlotte', 'Olivia', 'George', 'Amelia', 'Alexander', 'Sophie', 'Thomas', 'Emily',
        'Lukas', 'Sophie', 'Alexander', 'Marie', 'Maximilian', 'Sophia', 'Leon', 'Lena', 'Paul', 'Emma',
        'Lucas', 'Emma', 'Louis', 'Chloé', 'Gabriel', 'Inès', 'Jules', 'Léa', 'Adam', 'Manon',
        'Lorenzo', 'Giulia', 'Matteo', 'Sofia', 'Alessandro', 'Giorgia', 'Leonardo', 'Martina', 'Gabriele', 'Chiara',
        'Daniel', 'Lucía', 'Hugo', 'Sofía', 'Martín', 'María', 'Pablo', 'Valeria', 'Alejandro', 'Emma',
        'João', 'Mariana', 'Diogo', 'Beatriz', 'Miguel', 'Matilde', 'Francisco', 'Inês', 'Tiago', 'Leonor',
        'Daan', 'Emma', 'Lucas', 'Sophie', 'Levi', 'Julia', 'Sem', 'Mila', 'Finn', 'Tess',
        'Jules', 'Lotte', 'Lucas', 'Lotte', 'Adam', 'Julie', 'Liam', 'Elena', 'Noah', 'Eva',
        'Elias', 'Alice', 'William', 'Ella', 'Liam', 'Astrid', 'Oscar', 'Ebba', 'Noah', 'Maja',
        'Jakob', 'Nora', 'Emil', 'Sofie', 'Oliver', 'Emma', 'Mathias', 'Ida', 'Filip', 'Amalie',
        'Frederik', 'Ida', 'William', 'Emma', 'Oliver', 'Sofie', 'Noah', 'Freja', 'Lucas', 'Clara',
        'Elias', 'Emma', 'Oliver', 'Aino', 'Leo', 'Aada', 'Onni', 'Venla', 'Matti', 'Helmi',
        'Georgios', 'Eleni', 'Nikos', 'Maria', 'Dimitris', 'Sofia', 'Giannis', 'Despina', 'Panagiotis', 'Anna',
        'Lukas', 'Lara', 'Noah', 'Mia', 'Leandro', 'Lina', 'Julian', 'Elena', 'Liam', 'Lea',
        'Jakob', 'Anna', 'Lukas', 'Sophie', 'David', 'Julia', 'Sebastian', 'Emma', 'Felix', 'Lena',
        'Jack', 'Emily', 'James', 'Sophie', 'Daniel', 'Grace', 'Conor', 'Aoife', 'Sean', 'Amelia',
        'Jack', 'Olivia', 'James', 'Emily', 'Lewis', 'Sophie', 'Logan', 'Isla', 'Harris', 'Ava',
        'Oliver', 'Mia', 'Noah', 'Amelia', 'Jacob', 'Ava', 'Owen', 'Ella', 'George', 'Isla',
        'Jakub', 'Tereza', 'Adam', 'Eliška', 'Matěj', 'Anna', 'Tomáš', 'Barbora', 'Petr', 'Kateřina',
        'Bence', 'Anna', 'Levente', 'Réka', 'Márk', 'Zsófia', 'Ádám', 'Dóra', 'Bálint', 'Lilla',
        'Jakub', 'Zuzanna', 'Szymon', 'Julia', 'Jan', 'Maja', 'Filip', 'Hanna', 'Aleksander', 'Amelia',
        'Ionuț', 'Andreea', 'Mihai', 'Maria', 'Alexandru', 'Elena', 'Florin', 'Ana', 'Cristian', 'Ioana',
        'Georgi', 'Maria', 'Ivan', 'Sofia', 'Nikolay', 'Dimitrina', 'Stoyan', 'Elena',
        'Thiago', 'Julia', 'Pedro', 'Larissa', 'Lucas', 'Mariana', 'Mateo', 'Gabriela', 'Gabriel', 'Amanda',
        'Matías', 'Valentina', 'Diego', 'Sophia', 'Lucas', 'Isabella', 'Sebastián', 'Manuela', 'Tomás', 'Laura',
        'Juan', 'Camila', 'Miguel', 'Antonella', 'Nicolás', 'Isabel', 'Santiago', 'Emily', 'Emiliano', 'Sofía',
        'Samuel', 'Fernanda', 'Arthur', 'Giovanna', 'Heitor', 'Luiza', 'Davi', 'Júlia', 'Enzo', 'Lorena',
        'Felipe', 'Ana', 'Benício', 'Helena', 'Gustavo', 'Marina', 'Rafael', 'Luana', 'João', 'Isadora',
        'Diego', 'Valeria', 'Leandro', 'Daniela', 'Fernando', 'Bianca', 'Andrés', 'Carla', 'Esteban', 'Valentina',
        'Juan Pablo', 'Nicole', 'Rodrigo', 'Paula', 'Andrés Felipe', 'Jessica', 'Esteban', 'Maria José', 'David', 'Natalia',
        'Alexandre', 'Larissa', 'Felipe', 'Mariana', 'Matheus', 'Juliana', 'Marcos', 'Aline', 'Vinícius', 'Letícia',
        'Leonardo', 'Beatriz', 'Joaquim', 'Carolina', 'Daniel', 'Brenda', 'Rafael', 'Bruna', 'João Lucas', 'Eduarda',
        'Eduardo', 'Gabriela', 'Rodrigo', 'Camila', 'Lucas', 'Amanda', 'Pedro Henrique', 'Marina', 'Antônio', 'Julia',
        'Guilherme', 'Isabela', 'Vinícius', 'Amanda', 'Gustavo', 'Ana Clara', 'Henrique', 'Lívia', 'Raul', 'Maria Eduarda',
        'James', 'Emma', 'Oliver', 'Ava', 'Liam', 'Sophia', 'Noah', 'Isabella', 'William', 'Mia',
        'Lucas', 'Amelia', 'Benjamin', 'Charlotte', 'Henry', 'Evelyn', 'Alexander', 'Abigail', 'Mason', 'Harper',
        'Ethan', 'Sophia', 'Jacob', 'Isabella', 'Michael', 'Olivia', 'Daniel', 'Emma', 'Matthew', 'Ava',
        'Liam', 'Emily', 'William', 'Elizabeth', 'Benjamin', 'Sophie', 'Alexander', 'Ella', 'Lucas', 'Camila',
        'Jackson', 'Mia', 'Daniel', 'Victoria', 'Logan', 'Scarlett', 'Joseph', 'Grace', 'Samuel', 'Chloe',
        'Jack', 'Chloe', 'Jacob', 'Aria', 'William', 'Lily', 'Ethan', 'Olivia', 'Daniel', 'Sofia',
        'Noah', 'Avery', 'Lucas', 'Mila', 'Logan', 'Evelyn', 'Aiden', 'Harper', 'Jayden', 'Emily',
        'David', 'Madison', 'Matthew', 'Amelia', 'Wyatt', 'Ella', 'Alexander', 'Evelyn', 'John', 'Elizabeth',
        'James', 'Abigail', 'Benjamin', 'Ella', 'Michael', 'Grace', 'Luke', 'Anna', 'Henry', 'Avery',
        'Alexander', 'Hannah', 'Daniel', 'Samantha', 'Joseph', 'Aria', 'Gabriel', 'Scarlett', 'Joshua', 'Addison',
        'Samuel', 'Natalie', 'Jack', 'Zoe', 'Christopher', 'Audrey', 'William', 'Layla', 'Ryan', 'Leah',
        'Oliver', 'Charlotte', 'William', 'Ava', 'Jack', 'Mia', 'James', 'Amelia', 'Noah', 'Isla',
        'Lucas', 'Grace', 'Henry', 'Sophie', 'Liam', 'Chloe', 'Alexander', 'Emily', 'Ethan', 'Ruby',
        'Thomas', 'Zoe', 'Daniel', 'Harper', 'Samuel', 'Isabella', 'Matthew', 'Ella', 'Benjamin', 'Sophia',
        'Joshua', 'Mila', 'Max', 'Lily', 'Jacob', 'Sienna', 'Harry', 'Eva', 'Charlie', 'Scarlett',
        'Elijah', 'Matilda', 'William', 'Isabelle', 'Oscar', 'Abigail', 'Xavier', 'Evelyn', 'Cooper', 'Ivy',
        'Mason', 'Evie', 'Lachlan', 'Poppy', 'Jackson', 'Aria', 'Archie', 'Willow', 'Hudson', 'Alice',
        'Hunter', 'Lola', 'Leo', 'Georgia', 'Henry', 'Hannah', 'George', 'Charlotte', 'Levi', 'Madison',
        'Eli', 'Lucy', 'Ryan', 'Amber', 'Patrick', 'Imogen', 'Jordan', 'Audrey', 'Nathan', 'Eleanor',
        'Archer', 'Matilda', 'Blake', 'Jasmine', 'Finn', 'Alexandra', 'Caleb', 'Sarah', 'Jesse', 'Harriet',
        'Flynn', 'Ellie', 'Harvey', 'Claire', 'Nathaniel', 'Phoebe', 'Sam', 'Gabriella', 'Tyler', 'Leah',
    ];

    $countries = [
        'Saudi Arabia' => ['Riyadh', 'Jeddah', 'Mecca', 'Medina', 'Dammam'],
        'United Arab Emirates' => ['Abu Dhabi', 'Dubai', 'Sharjah', 'Al Ain', 'Ajman'],
        'Iran' => ['Tehran', 'Mashhad', 'Isfahan', 'Karaj', 'Shiraz'],
        'Iraq' => ['Baghdad', 'Basra', 'Erbil', 'Mosul', 'Kirkuk'],
        'Israel' => ['Jerusalem', 'Tel Aviv', 'Haifa', 'Ashdod', 'Beersheba'],
        'Jordan' => ['Amman', 'Zarqa', 'Irbid', 'Russeifa', 'Aqaba'],
        'Kuwait' => ['Kuwait City', 'Al Ahmadi', 'Hawalli', 'Salmiya', 'Sabah Al Salem'],
        'Lebanon' => ['Beirut', 'Tripoli', 'Sidon', 'Tyre', 'Zahle'],
        'Oman' => ['Muscat', 'Salalah', 'Sohar', 'Nizwa', 'Sur'],
        'Qatar' => ['Doha', 'Al Rayyan', 'Umm Salal', 'Al Khor', 'Al Wakrah'],
        'Bahrain' => ['Manama', 'Riffa', 'Muharraq', 'Hamad Town', 'A\'ali'],
        'Syria' => ['Damascus', 'Aleppo', 'Homs', 'Latakia', 'Hama'],
        'Turkey' => ['Istanbul', 'Ankara', 'Izmir', 'Bursa', 'Adana'],
        'Yemen' => ['Sana\'a', 'Aden', 'Taiz', 'Hodeidah', 'Ibb'],
        'India' => ['Mumbai', 'Delhi', 'Bangalore', 'Hyderabad', 'Ahmedabad', 'Kochi', 'Chennai'],
        'Pakistan' => ['Karachi', 'Lahore', 'Faisalabad', 'Rawalpindi', 'Multan'],
        'Bangladesh' => ['Dhaka', 'Chittagong', 'Khulna', 'Rajshahi', 'Sylhet'],
        'Sri Lanka' => ['Colombo', 'Kandy', 'Galle', 'Jaffna', 'Negombo'],
        'Nepal' => ['Kathmandu', 'Pokhara', 'Lalitpur', 'Biratnagar', 'Bharatpur'],
        'Bhutan' => ['Thimphu', 'Phuntsholing', 'Paro', 'Punakha', 'Jakar'],
        'Maldives' => ['Malé', 'Hithadhoo', 'Kulhudhuffushi', 'Thinadhoo', 'Naifaru'],
        'Indonesia' => ['Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Bekasi'],
        'Malaysia' => ['Kuala Lumpur', 'George Town', 'Ipoh', 'Shah Alam', 'Petaling Jaya'],
        'Philippines' => ['Manila', 'Quezon City', 'Davao City', 'Caloocan', 'Cebu City'],
        'Singapore' => ['Singapore'],
        'Thailand' => ['Bangkok', 'Nonthaburi', 'Nakhon Ratchasima', 'Chiang Mai', 'Hat Yai'],
        'Vietnam' => ['Hanoi', 'Ho Chi Minh City', 'Da Nang', 'Hai Phong', 'Can Tho'],
        'Russia' => ['Moscow', 'Saint Petersburg', 'Novosibirsk', 'Yekaterinburg', 'Kazan'],
        'Mongolia' => ['Ulaanbaatar', 'Erdenet', 'Darkhan', 'Choibalsan', 'Mörön'],
        'China' => ['Beijing', 'Shanghai', 'Guangzhou', 'Shenzhen', 'Tianjin'],
        'Japan' => ['Tokyo', 'Osaka', 'Yokohama', 'Nagoya', 'Sapporo'],
        'South Korea' => ['Seoul', 'Busan', 'Incheon', 'Daegu', 'Daejeon'],
        'North Korea' => ['Pyongyang', 'Hamhung', 'Nampo', 'Sunchon', 'Wonsan'],
        'Taiwan' => ['Taipei', 'Kaohsiung', 'Taichung', 'Tainan', 'Hsinchu'],
        'Hong Kong' => ['Hong Kong'],
        'Kazakhstan' => ['Nur-Sultan', 'Almaty', 'Shymkent', 'Karaganda', 'Aktobe'],
        'Uzbekistan' => ['Tashkent', 'Samarkand', 'Namangan', 'Andijan', 'Bukhara'],
        'Kyrgyzstan' => ['Bishkek', 'Osh', 'Jalal-Abad', 'Karakol', 'Tokmok'],
        'Turkmenistan' => ['Ashgabat', 'Turkmenabat', 'Dashoguz', 'Mary', 'Balkanabat'],
        'Tajikistan' => ['Dushanbe', 'Khujand', 'Kulob', 'Istaravshan', 'Tursunzoda'],
        'Brunei' => ['Bandar Seri Begawan', 'Kuala Belait', 'Seria', 'Tutong', 'Bangar'],
        'Timor-Leste' => ['Dili', 'Baucau', 'Maliana', 'Suai', 'Ainaro'],
        'Afghanistan' => ['Kabul', 'Herat', 'Kandahar', 'Mazar-i-Sharif', 'Jalalabad'],
        'Armenia' => ['Yerevan', 'Gyumri', 'Vanadzor', 'Vagharshapat', 'Hrazdan'],
        'Azerbaijan' => ['Baku', 'Ganja', 'Sumqayit', 'Mingachevir', 'Lankaran'],
        'Georgia' => ['Tbilisi', 'Kutaisi', 'Batumi', 'Rustavi', 'Zugdidi'],
        'Macau' => ['Macau'],
        'Mongolia' => ['Ulaanbaatar', 'Erdenet', 'Darkhan', 'Choibalsan', 'Mörön'],
        'United Kingdom' => ['London', 'Birmingham', 'Manchester', 'Glasgow', 'Liverpool'],
        'France' => ['Paris', 'Marseille', 'Lyon', 'Toulouse', 'Nice'],
        'Germany' => ['Berlin', 'Hamburg', 'Munich', 'Cologne', 'Frankfurt'],
        'Italy' => ['Rome', 'Milan', 'Naples', 'Turin', 'Palermo'],
        'Spain' => ['Madrid', 'Barcelona', 'Valencia', 'Seville', 'Zaragoza'],
        'Netherlands' => ['Amsterdam', 'Rotterdam', 'The Hague', 'Utrecht', 'Eindhoven'],
        'Belgium' => ['Brussels', 'Antwerp', 'Ghent', 'Charleroi', 'Liège'],
        'Sweden' => ['Stockholm', 'Gothenburg', 'Malmö', 'Uppsala', 'Västerås'],
        'Norway' => ['Oslo', 'Bergen', 'Stavanger', 'Trondheim', 'Drammen'],
        'Denmark' => ['Copenhagen', 'Aarhus', 'Odense', 'Aalborg', 'Esbjerg'],
        'Finland' => ['Helsinki', 'Espoo', 'Tampere', 'Vantaa', 'Oulu'],
        'Poland' => ['Warsaw', 'Kraków', 'Łódź', 'Wrocław', 'Poznań'],
        'Greece' => ['Athens', 'Thessaloniki', 'Patras', 'Heraklion', 'Larissa'],
        'Portugal' => ['Lisbon', 'Porto', 'Amadora', 'Braga', 'Coimbra'],
        'Austria' => ['Vienna', 'Graz', 'Linz', 'Salzburg', 'Innsbruck'],
        'Switzerland' => ['Zurich', 'Geneva', 'Basel', 'Lausanne', 'Bern'],
        'Hungary' => ['Budapest', 'Debrecen', 'Szeged', 'Miskolc', 'Pécs'],
        'Czech Republic' => ['Prague', 'Brno', 'Ostrava', 'Plzeň', 'Liberec'],
        'Romania' => ['Bucharest', 'Cluj-Napoca', 'Timișoara', 'Iași', 'Constanța'],
        'Bulgaria' => ['Sofia', 'Plovdiv', 'Varna', 'Burgas', 'Ruse'],
        'Nigeria' => ['Lagos', 'Kano', 'Ibadan', 'Abuja', 'Port Harcourt'],
        'Ethiopia' => ['Addis Ababa', 'Dire Dawa', 'Mekelle', 'Gondar', 'Hawassa'],
        'Egypt' => ['Cairo', 'Alexandria', 'Giza', 'Shubra El-Kheima', 'Port Said'],
        'South Africa' => ['Johannesburg', 'Cape Town', 'Durban', 'Pretoria', 'Port Elizabeth'],
        'Kenya' => ['Nairobi', 'Mombasa', 'Nakuru', 'Eldoret', 'Kisumu'],
        'Ghana' => ['Accra', 'Kumasi', 'Tamale', 'Takoradi', 'Ashaiman'],
        'Uganda' => ['Kampala', 'Gulu', 'Lira', 'Mbarara', 'Jinja'],
        'Tanzania' => ['Dar es Salaam', 'Dodoma', 'Mwanza', 'Arusha', 'Mbeya'],
        'Algeria' => ['Algiers', 'Oran', 'Constantine', 'Annaba', 'Blida'],
        'Morocco' => ['Casablanca', 'Rabat', 'Fes', 'Marrakech', 'Agadir'],
        'Angola' => ['Luanda', 'Huambo', 'Lobito', 'Benguela', 'Kuito'],
        'Ivory Coast' => ['Abidjan', 'Bouaké', 'Daloa', 'San Pedro', 'Yamoussoukro'],
        'Senegal' => ['Dakar', 'Touba', 'Thiès', 'Rufisque', 'Kaolack'],
        'Cameroon' => ['Douala', 'Yaoundé', 'Garoua', 'Bamenda', 'Maroua'],
        'Zimbabwe' => ['Harare', 'Bulawayo', 'Chitungwiza', 'Mutare', 'Gweru'],
        'Argentina' => ['Buenos Aires', 'Córdoba', 'Rosario', 'Mendoza', 'La Plata'],
        'Brazil' => ['São Paulo', 'Rio de Janeiro', 'Brasília', 'Salvador', 'Fortaleza'],
        'Chile' => ['Santiago', 'Valparaíso', 'Concepción', 'La Serena', 'Antofagasta'],
        'Colombia' => ['Bogotá', 'Medellín', 'Cali', 'Barranquilla', 'Cartagena'],
        'Peru' => ['Lima', 'Arequipa', 'Trujillo', 'Chiclayo', 'Iquitos'],
        'Venezuela' => ['Caracas', 'Maracaibo', 'Valencia', 'Barquisimeto', 'Ciudad Guayana'],
        'Ecuador' => ['Quito', 'Guayaquil', 'Cuenca', 'Santo Domingo', 'Machala'],
        'Bolivia' => ['La Paz', 'Santa Cruz', 'Cochabamba', 'Oruro', 'Sucre'],
        'Paraguay' => ['Asunción', 'Ciudad del Este', 'San Lorenzo', 'Luque', 'Encarnación'],
        'Uruguay' => ['Montevideo', 'Salto', 'Paysandú', 'Las Piedras', 'Rivera'],
        'Guyana' => ['Georgetown', 'Linden', 'New Amsterdam', 'Bartica', 'Skeldon'],
        'Suriname' => ['Paramaribo', 'Lelydorp', 'Nieuw Nickerie', 'Moengo', 'Albina'],
        'French Guiana' => ['Cayenne', 'Saint-Laurent-du-Maroni', 'Kourou', 'Matoury', 'Rémire-Montjoly'],
        'United States' => ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix', 'Philadelphia', 'San Antonio', 'San Diego', 'Dallas', 'San Jose'],
        'Canada' => ['Toronto', 'Montreal', 'Vancouver', 'Calgary', 'Edmonton', 'Ottawa', 'Winnipeg', 'Quebec City', 'Hamilton', 'Kitchener'],
        'Mexico' => ['Mexico City', 'Guadalajara', 'Monterrey', 'Puebla', 'Tijuana', 'León', 'Ciudad Juárez', 'Zapopan', 'Monterrey', 'Chihuahua'],
        'Guatemala' => ['Guatemala City', 'Mixco', 'Villa Nueva', 'Quetzaltenango', 'Escuintla'],
        'Belize' => ['Belize City', 'San Ignacio', 'Orange Walk', 'Belmopan', 'Dangriga'],
        'El Salvador' => ['San Salvador', 'Santa Ana', 'San Miguel', 'Soyapango', 'Santa Tecla'],
        'Honduras' => ['Tegucigalpa', 'San Pedro Sula', 'Choloma', 'La Ceiba', 'El Progreso'],
        'Nicaragua' => ['Managua', 'León', 'Masaya', 'Chinandega', 'Matagalpa'],
        'Costa Rica' => ['San José', 'Alajuela', 'Cartago', 'Heredia', 'Liberia'],
        'Panama' => ['Panama City', 'San Miguelito', 'Tocumen', 'David', 'Colón'],
        'Cuba' => ['Havana', 'Santiago de Cuba', 'Camagüey', 'Holguín', 'Santa Clara'],
        'Haiti' => ['Port-au-Prince', 'Cap-Haïtien', 'Carrefour', 'Delmas', 'Pétionville'],
        'Dominican Republic' => ['Santo Domingo', 'Santiago', 'La Romana', 'San Pedro de Macorís', 'San Francisco de Macorís'],
        'Jamaica' => ['Kingston', 'Montego Bay', 'Spanish Town', 'Portmore', 'May Pen'],
        'Trinidad and Tobago' => ['Port of Spain', 'Chaguanas', 'San Fernando', 'Arima', 'Point Fortin'],
        'Barbados' => ['Bridgetown', 'Speightstown', 'Oistins', 'Bathsheba', 'Holetown'],
        'Bahamas' => ['Nassau', 'Freeport', 'West End', 'Coopers Town', 'Marsh Harbour'],
        'Saint Lucia' => ['Castries', 'Vieux Fort', 'Micoud', 'Soufrière', 'Dennery'],
        'Saint Vincent and the Grenadines' => ['Kingstown', 'Georgetown', 'Chateaubelair', 'Barrouallie', 'Port Elizabeth'],
        'Grenada' => ['St. George\'s', 'Grenville', 'Gouyave', 'Victoria', 'Sauteurs'],
        'Antigua and Barbuda' => ['St. John\'s', 'All Saints', 'Liberta', 'Bolans', 'Piggotts'],
        'Dominica' => ['Roseau', 'Portsmouth', 'Marigot', 'Berekua', 'Mahaut'],
        'Saint Kitts and Nevis' => ['Basseterre', 'Charlestown', 'Sandy Point Town', 'Monkey Hill', 'Cayon'],
        'Australia' => ['Sydney', 'Melbourne', 'Brisbane', 'Perth', 'Adelaide'],
        'New Zealand' => ['Auckland', 'Wellington', 'Christchurch', 'Hamilton', 'Tauranga'],
        'Papua New Guinea' => ['Port Moresby', 'Lae', 'Madang', 'Mount Hagen', 'Wewak'],
        'Fiji' => ['Suva', 'Nadi', 'Lautoka', 'Labasa', 'Ba'],
        'Solomon Islands' => ['Honiara', 'Gizo', 'Auki', 'Kirakira', 'Taro'],
        'Vanuatu' => ['Port Vila', 'Luganville', 'Norsup', 'Port-Olry', 'Sola'],
        'New Caledonia' => ['Nouméa', 'Mont-Dore', 'Dumbéa', 'Païta', 'Wé'],
        'French Polynesia' => ['Papeete', 'Faaa', 'Punaauia', 'Pirae', 'Mahina'],
        'Samoa' => ['Apia', 'Asau', 'Afega', 'Leulumoega', 'Faleula'],
        'Tonga' => ['Nukuʻalofa', 'Neiafu', 'Haveluloto', 'Vaini', 'Pangai'],
        'Kiribati' => ['South Tarawa', 'Betio', 'Bikenibeu', 'Teaoraereke', 'Taburao'],
        'Tuvalu' => ['Funafuti', 'Vaiaku', 'Teava', 'Fongafale', 'Tanrake'],
        'Nauru' => ['Yaren', 'Denigomodu', 'Anabar', 'Uaboe', 'Meneng'],
        'Cook Islands' => ['Avarua', 'Arutanga', 'Amuri', 'Atiu', 'Muri'],
        'Palau' => ['Ngerulmud', 'Koror', 'Melekeok', 'Airai', 'Ngaremlengui'],
        'Micronesia' => ['Palikir', 'Weno', 'Kolonia', 'Tofol', 'Nan Madol'],
        'Marshall Islands' => ['Majuro', 'Kwajalein', 'Arno', 'Jaluit', 'Wotje'],
        'Northern Mariana Islands' => ['Saipan', 'Tinian', 'Rota', 'San Jose', 'Kagman'],
        'Guam' => ['Hagåtña', 'Dededo', 'Tamuning', 'Mangilao', 'Yigo'],
    ];

    $occupations = [
        'Accountant', 'Actor', 'Actuary', 'Aerospace Engineer', 'Agricultural Engineer',
        'Air Traffic Controller', 'Aircraft Mechanic', 'Airline Pilot', 'Animator',
        'Architect', 'Art Director', 'Artist', 'Astronomer', 'Athlete', 'Attorney',
        'Author', 'Baker', 'Barber', 'Bartender', 'Biochemist', 'Biologist',
        'Bookkeeper', 'Bricklayer', 'Bus Driver', 'Carpenter', 'Chef', 'Chemical Engineer',
        'Chemist', 'Chiropractor', 'Civil Engineer', 'Claims Adjuster', 'Coach',
        'Comedian', 'Computer Programmer', 'Conservationist', 'Construction Worker',
        'Copywriter', 'Cosmetologist', 'Counselor', 'Curator', 'Dancer',
        'Dental Hygienist', 'Dentist', 'Detective', 'Dietitian', 'Director',
        'Doctor', 'Dog Trainer', 'Economist', 'Editor', 'Electrician',
        'Engineer', 'Entertainer', 'Entrepreneur', 'Environmental Scientist', 'Event Planner',
        'Fashion Designer', 'FBI Agent', 'Film Director', 'Financial Analyst', 'Firefighter',
        'Fisherman', 'Fitness Trainer', 'Flight Attendant', 'Forensic Scientist', 'Game Designer',
        'Gardener', 'Geologist', 'Graphic Designer', 'Hairdresser', 'Historian',
        'Home Inspector', 'Housekeeper', 'Human Resources Manager', 'Illustrator', 'Industrial Designer',
        'Information Security Analyst', 'Insurance Agent', 'Interior Designer', 'Interpreter', 'Investment Banker',
        'Janitor', 'Journalist', 'Judge', 'Landscaper', 'Lawyer', 'Librarian',
        'Lifeguard', 'Linguist', 'Loan Officer', 'Locksmith', 'Makeup Artist',
        'Management Consultant', 'Market Research Analyst', 'Marketing Manager', 'Massage Therapist',
        'Mathematician', 'Mechanic', 'Medical Assistant', 'Medical Examiner', 'Meteorologist',
        'Microbiologist', 'Military Officer', 'Model', 'Musician', 'Network Administrator',
        'Nurse', 'Occupational Therapist', 'Oceanographer', 'Optometrist', 'Painter',
        'Paralegal', 'Paramedic', 'Park Ranger', 'Pediatrician', 'Personal Trainer',
        'Pharmacist', 'Phlebotomist', 'Photographer', 'Physical Therapist', 'Physician',
        'Physicist', 'Pilot', 'Plumber', 'Police Officer', 'Political Scientist',
        'Postman', 'Preschool Teacher', 'Principal', 'Private Investigator', 'Producer',
        'Professor', 'Programmer', 'Project Manager', 'Psychiatrist', 'Psychologist',
        'Radiologist', 'Real Estate Agent', 'Receptionist', 'Recruiter', 'Reporter',
        'Restaurant Manager', 'Retail Sales Associate', 'Robotics Engineer', 'Roofer',
        'Sales Manager', 'Scientist', 'Sculptor', 'Secretary', 'Security Guard',
        'Social Media Manager', 'Social Worker', 'Software Developer', 'Speech Therapist',
        'Statistician', 'Stockbroker', 'Surgeon', 'Surveyor', 'Systems Analyst',
        'Taxi Driver', 'Teacher', 'Technical Writer', 'Technician', 'Telecommunications Specialist',
        'Translator', 'Travel Agent', 'Truck Driver', 'Urban Planner', 'Usher',
        'Veterinarian', 'Video Editor', 'Waiter/Waitress', 'Web Developer', 'Welder',
        'Writer', 'Zoologist'
    ];

    $data = [];

    foreach (range(1, $count) as $index) {
        $randomName = $names[array_rand($names)];
        $randomAge = mt_rand(18, 60); // Generate a random age between 18 and 60

        // Apply city and country filters if provided
        if ($countryFilter && $cityFilter && isset($countries[$countryFilter]) && in_array($cityFilter, $countries[$countryFilter])) {
            $randomCountry = $countryFilter;
            $randomCity = $cityFilter;
        } else {
            $randomCountry = array_rand($countries);
            $randomCity = $countries[$randomCountry][array_rand($countries[$randomCountry])];
        }

        $randomOccupation = $occupations[array_rand($occupations)];

        $data[] = [
            'name' => $randomName,
            'age' => $randomAge,
            'country' => $randomCountry,
            'city' => $randomCity,
            'occupation' => $randomOccupation,
            'timestamp' => date('Y-m-d H:i:s')
        ];
    }

    return $data;
}

// Validate API token
$api_token = $_GET['api_token'] ?? '';
if (!validateToken($api_token)) {
    echo json_encode(["error" => "Invalid API token"]);
    exit();
}

// Get count from query parameter
$count = isset($_GET['count']) ? intval($_GET['count']) : 1;
$count = $count > 0 ? $count : 1;

// Get country and city filters from query parameters
$countryFilter = isset($_GET['country']) ? $_GET['country'] : null;
$cityFilter = isset($_GET['city']) ? $_GET['city'] : null;

// Output filtered random data as JSON
header('Content-Type: application/json');
echo json_encode(generateRandomData($count, $countryFilter, $cityFilter));

$conn->close();
?>
