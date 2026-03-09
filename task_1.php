<?php
interface LeadInterface {
    public function getManagementStyle(): string;
    public function getTeamSize(): int;
    public function manageTask(string $task): string;
}
interface ApplicationCreatorInterface {
    public function getProgrammingLanguages(): array;
    public function developFeature(string $feature): string;
    public function getCodeReview(string $code): string;
}
interface WebinarSpeakerInterface {
    public function getWebinarTopics(): array;
    public function conductWebinar(string $topic): string;
    public function getWebinarSchedule(): string;
}
abstract class Employee {
    protected string $firstName;
    protected string $lastName;
    protected int $salary;
    protected string $department;
    protected int $experienceYears;
    protected static int $totalEmployees = 0;
    protected static int $totalSalary = 0;
    public function __construct(string $firstName, string $lastName, int $salary, string $department, int $experienceYears) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->setSalary($salary);
        $this->department = $department;
        $this->experienceYears = $experienceYears;
        
        self::$totalEmployees++;
        self::$totalSalary += $this->salary;
    }
    public function getFullName(): string {
        return $this->firstName . ' ' . $this->lastName;
    }
    public function setSalary(int $salary): void {
        if ($salary > 0) {
            $this->salary = $salary;
        }
    }
    public function getSalary(): int {
        return $this->salary;
    }
    public function getDepartment(): string {
        return $this->department;
    }
    public function getExperienceYears(): int {
        return $this->experienceYears;
    }
    public function work(): string {
        return "Выполняет свои обязанности";
    }
    abstract public function getPosition(): string;
    public static function getTotalEmployees(): int {
        return self::$totalEmployees;
    }
    public static function getTotalSalary(): int {
        return self::$totalSalary;
    }
}
class Programmer extends Employee implements ApplicationCreatorInterface, WebinarSpeakerInterface {
    private array $programmingLanguages;
    private string $framework;
    private string $ide;
    private array $webinarTopics = ['Технические темы', 'Новые технологии', 'Лучшие практики кодинга'];
    public function __construct(string $firstName, string $lastName, int $salary, string $department, int $experienceYears, array $programmingLanguages, string $framework, string $ide) {
        parent::__construct($firstName, $lastName, $salary, $department, $experienceYears);
        $this->programmingLanguages = $programmingLanguages;
        $this->framework = $framework;
        $this->ide = $ide;
    }
    public function getProgrammingLanguages(): array {
        return $this->programmingLanguages;
    }
    public function developFeature(string $feature): string {
        return "Разрабатывает функциональность: " . $feature;
    }
    public function getCodeReview(string $code): string {
        return "Проводит ревью кода: " . $code;
    }
    public function getWebinarTopics(): array {
        return $this->webinarTopics;
    }
    public function conductWebinar(string $topic): string {
        return "Проводит вебинар на тему: " . $topic;
    }
    public function getWebinarSchedule(): string {
        return "Вебинары проводятся каждый вторник в 18:00";
    }
    public function getPosition(): string {
        return "Программист";
    }
    public function writeCode(string $task): string {
        return "Пишет код для задачи: " . $task;
    }
    public function debug(string $code): string {
        return "Отлаживает код: " . $code;
    }
    public function getFramework(): string {
        return $this->framework;
    }
}
class Tester extends Employee implements ApplicationCreatorInterface {
    private array $testingTools;
    private string $testingType;
    private int $bugsFound;
    private array $programmingLanguages = ['JavaScript', 'Python'];
    public function __construct(string $firstName, string $lastName, int $salary, string $department, int $experienceYears, array $testingTools, string $testingType) {
        parent::__construct($firstName, $lastName, $salary, $department, $experienceYears);
        $this->testingTools = $testingTools;
        $this->testingType = $testingType;
        $this->bugsFound = 0;
    }
    public function getProgrammingLanguages(): array {
        return $this->programmingLanguages;
    }
    public function developFeature(string $feature): string {
        return "Пишет автотесты для функциональности: " . $feature;
    }
    public function getCodeReview(string $code): string {
        return "Анализирует код на предмет потенциальных багов: " . $code;
    }
    public function getPosition(): string {
        return "Тестировщик";
    }
    public function testFeature(string $feature): string {
        $this->bugsFound += rand(1, 5);
        return "Тестирует функциональность: " . $feature;
    }
    public function reportBug(string $bug): string {
        return "Сообщает о баге: " . $bug;
    }
    public function getBugsFound(): int {
        return $this->bugsFound;
    }
    public function createTestPlan(): string {
        return "Создает план тестирования для нового релиза";
    }
}
class Manager extends Employee implements LeadInterface, WebinarSpeakerInterface {
    private int $teamSize;
    private string $managementStyle;
    private array $projects;
    private array $webinarTopics = ['Управление проектами', 'Мотивация команды', 'Эффективные коммуникации'];
    public function __construct(string $firstName, string $lastName, int $salary, string $department, int $experienceYears, int $teamSize, string $managementStyle, array $projects) {
        parent::__construct($firstName, $lastName, $salary, $department, $experienceYears);
        $this->teamSize = $teamSize;
        $this->managementStyle = $managementStyle;
        $this->projects = $projects;
    }
    public function getManagementStyle(): string {
        return $this->managementStyle;
    }
    public function getTeamSize(): int {
        return $this->teamSize;
    }
    public function manageTask(string $task): string {
        return "Распределяет задачу между командой: " . $task;
    }
    public function getWebinarTopics(): array {
        return $this->webinarTopics;
    }
    public function conductWebinar(string $topic): string {
        return "Проводит вебинар для менеджеров на тему: " . $topic;
    }
    public function getWebinarSchedule(): string {
        return "Вебинары проводятся каждый четверг в 15:00";
    }
    public function getPosition(): string {
        return "Менеджер";
    }
    public function holdMeeting(string $meetingTopic): string {
        return "Проводит совещание по теме: " . $meetingTopic;
    }
    public function assignTask(string $task, Employee $employee): string {
        return "Назначает задачу '" . $task . "' сотруднику " . $employee->getFullName();
    }
    public function getCurrentProjects(): array {
        return $this->projects;
    }
}
class Director extends Employee implements LeadInterface, WebinarSpeakerInterface {
    private int $teamSize;
    private string $managementStyle;
    private string $companyStrategy;
    private string $officeLocation;
    private array $webinarTopics = ['Стратегическое планирование', 'Лидерство', 'Развитие бизнеса'];
    public function __construct(string $firstName, string $lastName, int $salary, string $department, int $experienceYears, int $teamSize, string $managementStyle, string $companyStrategy, string $officeLocation) {
        parent::__construct($firstName, $lastName, $salary, $department, $experienceYears);
        $this->teamSize = $teamSize;
        $this->managementStyle = $managementStyle;
        $this->companyStrategy = $companyStrategy;
        $this->officeLocation = $officeLocation;
    }
    public function getManagementStyle(): string {
        return $this->managementStyle;
    }
    public function getTeamSize(): int {
        return $this->teamSize;
    }
    public function manageTask(string $task): string {
        return "Ставит стратегическую задачу: " . $task;
    }
    public function getWebinarTopics(): array {
        return $this->webinarTopics;
    }
    public function conductWebinar(string $topic): string {
        return "Проводит вебинар для руководителей на тему: " . $topic;
    }
    public function getWebinarSchedule(): string {
        return "Вебинары проводятся раз в месяц по пятницам";
    }
    public function getPosition(): string {
        return "Директор";
    }
    public function defineStrategy(): string {
        return "Определяет стратегию компании: " . $this->companyStrategy;
    }
    public function approveBudget(int $amount): string {
        return "Утверждает бюджет в размере " . $amount . " попугаев";
    }
    public function getOfficeLocation(): string {
        return $this->officeLocation;
    }
    public function holdGeneralMeeting(): string {
        return "Проводит общее собрание сотрудников";
    }
}
$programmer1 = new Programmer(
    "Иван", 
    "Петров", 
    30, 
    "Разработка", 
    5, 
    ["PHP", "JavaScript", "Python"], 
    "Laravel", 
    "PHPStorm"
);
$programmer2 = new Programmer(
    "Мария", 
    "Сидорова", 
    28, 
    "Разработка", 
    3, 
    ["Java", "Kotlin", "SQL"], 
    "Spring", 
    "IntelliJ IDEA"
);
$tester1 = new Tester(
    "Алексей", 
    "Иванов", 
    22, 
    "Тестирование", 
    2, 
    ["Selenium", "JUnit", "Postman"], 
    "Автоматизированное"
);
$tester2 = new Tester(
    "Елена", 
    "Козлова", 
    20, 
    "Тестирование", 
    1, 
    ["TestRail", "JIRA", "Charles"], 
    "Ручное"
);
$manager1 = new Manager(
    "Сергей", 
    "Михайлов", 
    35, 
    "Управление", 
    7, 
    8, 
    "Демократический", 
    ["Проект А", "Проект Б"]
);
$director1 = new Director(
    "Анна", 
    "Волкова", 
    50, 
    "Руководство", 
    12, 
    25, 
    "Стратегический", 
    "Расширение на рынок Азии", 
    "Бизнес-центр 'Плаза'"
);
$employees = [$programmer1, $programmer2, $tester1, $tester2, $manager1, $director1];
foreach ($employees as $employee) {
    $features = [];
    if ($employee instanceof ApplicationCreatorInterface) {
        $langs = implode(", ", $employee->getProgrammingLanguages());
        $features[] = "может заниматься разработкой приложения: знает " . $langs;
    }
    if ($employee instanceof WebinarSpeakerInterface) {
        $topics = implode(", ", array_slice($employee->getWebinarTopics(), 0, 2));
        $features[] = "может проводить вебинары: на темы " . $topics . " и другие";
    }
    if ($employee instanceof LeadInterface) {
        $features[] = "руководит командой из " . $employee->getTeamSize() . " человек, стиль: " . $employee->getManagementStyle();
    }
    $featuresText = !empty($features) ? implode(", ", $features) : "выполняет основные обязанности";   
    echo $employee->getFullName() . ", позиция: " . $employee->getPosition() . 
         ", зарплата: " . $employee->getSalary() . " попугаев, " . $featuresText . ".\n";
}
echo "\nОбщее количество сотрудников: " . Employee::getTotalEmployees() . ".\n";
echo "Общая сумма зарплат: " . Employee::getTotalSalary() . " попугаев.\n";
?>
