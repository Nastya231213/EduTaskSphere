<h2 align="center">Lab №2 </h2>
<h3>1. Singleton Pattern</h3>
У випадку з класом <a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/Pagination.php">Pagination</a> потрібно забезпечити, що буде створений тільки один екземпляр для роботи з пагінацією. Це допомагає уникнути потенційних проблем, які можуть виникнути при створенні декількох екземплярів,
 таких як несинхронізовані дані або надмірне споживання ресурсів.
 <h5>Переваги:</h5>
 <ul>
   <li>Використання Singleton гарантує, що клас Pagination має лише один екземпляр</li>
   <li>Об'єкт створюється лише тоді, коли він дійсно потрібен, що економить ресурси</li>
 </ul>
 <h3>2. Template Method Pattern</h3>
 Патерн Template Method дозволяє створити загальну схему роботи в базовому класі, залишаючи деякі конкретні кроки для реалізації в підкласах.
 В абстрактному класі <a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/Tasks.php">Tasks</a> визначено загальні методи для взаємодії з базою даних і абстрактний метод для додавання підзавдання.
 Конкретні підкласи <a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/SimpleTasks.php">SimpleTasks</a> та <a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/ComlexTask.php">ComplexTask</a> реалізують цей метод, додаючи специфічну логіку для роботи з підзавданнями.
 <h5>Переваги:</h5>
 <ul>
   <li>Повторне використання коду:</li>
 </ul>
 <h5>Недоліки:</h5>
 
 <ul>
   <li>Зростання кількості підкласів може ускладнити управління кодом</li>
   <li>Обмежена гнучкість</li>
 </ul>

 <h3>3. Command Pattern</h3>
<p>У цьому коді використовується патерн Command (Команда), який дозволяє інкапсулювати запити як об'єкти, 
тим самим дозволяючи параметризувати клієнтів з різними запитами, чергувати або логувати запити, а також підтримувати скасування операцій.<br>
Кожен клас, який реалізує інтерфейс <a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/Command.php">Command</a>, представляє окрему команду. Є кілька таких класів: <a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/SendTaskToPupil.php">SendTaskToPupil</a>, <a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/DeletePupilFromTeacher.php">DeletePupilFromTeacher</a>, 
 <a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/DeleteTaskFromPupil.php">DeleteTaskFromPupil</a>,<a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/AddPupilToTeacher.php"> AddPupilToTeacher</a>.
 <ul>
   <li>SendTaskToPupil: Відправляє завдання учню.</li>
   <li>DeletePupilFromTeacher: Видаляє учня від вчителя</li>
      <li>DeleteTaskFromPupil: Видаляє завдання учня.</li>
   <li>AddPupilToTeacher: Додає учня до вчителя.</li>
 </ul> 
Клас <a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/CommandInvoker.php">CommandInvoker</a> має метод , що встановлює команду для виконання і метод, який виконує її

</p>
<h3>4. Factory Method Pattern </h3>
<p>
  Патерн Factory Method забезпечує створення різних типів підзавдань 
  через інтерфейс <a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/SubtaskFactory.php">SubtaskFactory</a> і його конкретну реалізацію ConcreteSubTaskFactory.
  Інтерфейс SubTask визначає базові методи, які повинні бути реалізовані у всіх класах підзавданнь:
  <ul>
    <li><a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/OpenEndedTask.php">OpenEndedTask</a></li>
    <li><a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/MultipleChoiceTask.php">MultipleChoiceTask</a></li>
    <li><a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/TestSubtask.php">TestTask</a></li>
  </ul>
</p>
 <h5>Переваги:</h5>
 <ul>
   <li>Гнучкість і розширюваність</li>
   <li>Відокремлення створення об'єктів від їх використання</li>
   <li>Заміна підкласів</li>
 </ul>

 <h3>5. Strategy Pattern </h3>
 Патерн Strategy використовується для реалізації різних методів обробки підзавдань.
 Інтерфейс <a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/SubTaskStrategy.php">SubTaskStrategy</a> визначає загальні методи для всіх стратегій.Конкретні стратегії:
 <a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/OpenEndedStrategy.php">OpenEndedStrategy</a> клас, 
 <a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/MultipleChoiceStrategy.php">MultipleChoiceStrategy</a> клас, 
 <a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/TestStrategy.php">TestStrategy</a> клас<br>
  <h5>Переваги:</h5>
 <ul>
   <li>Гнучкість і розширюваність</li>
   <li>Система легко розширюється новими стратегіями без змін у старому коді</li>
 </ul><h3>6. Observer Pattern</h3>
 <a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/Observer.php">Observer</a> -це інтерфейс, який визначає метод sendNotification,що викликається об'єктом під час події.
<a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/User.php">User</a> клас реалізує інтерфейс спостерігача. Він має метод sendNotification, який викликається при сповіщенні про подію.
<a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/NotificationManager.php">NotificationManager</a>-це об'єкт, який здійснює відслідковування та надсилає повідомлення всім підписаним спостерігачам.
<h5>Переваги:</h5>
 <ul>
   <li>Розширюваність: Цей паттерн дозволяє додавати нові спостерігачі без зміни суб'єкта і навпаки</li>
   <li>Спостерігачі і суб'єкти знаходяться відокремлено один від одного, що дозволяє легше керувати кодом</li>
 </ul>
<h3>7. State Pattern</h3>
Цей патерн дозволяє те, щоб поведінка об'єкта змінюється в залежності від його стану.
Завдання може змінювати свій стан (Всього на три стана : "In Progress", "Completed","Review" ) без зміни його коду.
<h5>Переваги:</h5>
 <ul>
   <liРозширюваність</li>
   <li>Кожен стан інкапсулює свою логіку, що робить код більш зрозумілим та підтримуваним./li>
 </ul>
 <h3>8.Interpreter Pattern</h3>
 Interpreter Pattern реалізується через інтерфейс <a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/Interpreter.php">Interpreter</a> і кілька класів, які його реалізують. 
 Класи <a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/DeadlineFilter.php">DeadlineFilter</a>,<a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/SearchKeyFilter.php">SearchKeyFilter</a> та <a href="https://github.com/Nastya231213/EduTaskSphere/blob/main/private/models/SubjectFilter.php">SubjectFilter</a> реалізують цей інтерфейс 
 і використовуються для фільтрації задач за допомогою різних критеріїв (термін виконання, ключове слово, предмет).
   <h5>Переваги:</h5>
 <ul>
   <li>Гнучкість і розширюваність</li>
   <li>Зрозумілість</li>
 </ul>
    <h5>Недоліки:</h5>
 <ul>
   <li> Використання великої кількості інтерпретаторів може призвести до зниження продуктивності, особливо якщо обробляються великі обсяги даних.</li>
 </ul>
 <h3>Ще два паттерна  реалізовані в <a href="https://github.com/Nastya231213/ProjectForTheSecondTerm/tree/main">проекті за другий семестр</a></h3>
 <h3>9. Chain of Responsibility Pattern </h3>
 <a href="https://github.com/Nastya231213/ProjectForTheSecondTerm/blob/main/private/models/AbstractReviewHandler.php">AbstractReviewHandler</a> є абстрактним класом, який реалізує інтерфейс ReviewHandler. Він містить поле $nextHandler, яке зберігає посилання на наступний обробник у ланцюжку.
 У конструкторі класу ReviewProcessor створюється ланцюг обробників: ValidationHandler → FilteringHandler → StorageHandler. 
 <h5>Переваги:</h5>
 <ul>
   <li>Гнучкість і розширюваність</li>
 </ul>
  <h5>Недоліки:</h5>
 <ul>
   <li>Важко зрозуміти і налаштувати правильний порядок обробників.</li>
 </ul>
 <h3>10. Facade Pattern</h3>
 <a href="https://github.com/Nastya231213/ProjectForTheSecondTerm/blob/main/private/models/OrderFacadeImpl.php">OrderFacadeImpl</a> реалізує інтерфейс OrderFacade та надає конкретну реалізацію методів для роботи зі замовленнями. Він має методи placeOrder($dataOrder, $cartItems) та getOrdersOfTheUser($userId),
які використовуються для розміщення замовлення та отримання замовлень користувача відповідно.Клас PaymentProcessor відповідає за обробку платежів.
 <h5>Переваги:</h5>
 <ul>
   <li>Гнучкість і розширюваність</li>
   <li>Зменшення залежностей між підсистемами</li>
 </ul>
  <h5>Недоліки:</h5>
 <ul>
   <li>Гнучкість і розширюваність</li>
   <li>Зменшення залежностей між підсистемами</li>
 </ul>
