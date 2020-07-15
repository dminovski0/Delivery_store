--
-- Table structure for table `pizzaproduct`
--

CREATE TABLE `pizzaproduct` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `price_euro` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pizzaproduct`
--

INSERT INTO `pizzaproduct` (`id`, `name`, `code`, `image`, `description`, `price`, `price_euro`) VALUES
(1, 'Cheese Pizza', 'CHP', 'images/Cheese Pizza.jpg', 'It should be no shocker that a classic is the statistical favorite. Cheese pizza is one of the most popular choices. It will always be a simple, unadorned masterpiece on its own.', 29.99, 26.09),
(2, 'Veggie Pizza', 'VEP',  'images/Veggie Pizza.jpg', 'When you want to jazz up your cheese pizza with color and texture, veggies are the perfect topping. And you''re only limited by your imagination. Everything from peppers and mushrooms, to eggplant and onions make for an exciting and tasty veggie pizza.', 249, 216.63),
(3, 'Pepperoni Pizza', 'PEP', 'images/Pepperoni Pizza.jpg', 'There''s a reason this is one of the most popular types of pizza. Who doesn''t love biting into a crispy, salty round of pepperoni?', 39.99, 34.79),
(4, 'Meat Pizza', 'MEP', 'images/Meat Pizza.jpg', 'If pepperoni just isn''t enough, and you''re looking for a pie with a bit more heft, a meat pizza is a perfect and popular choice. Pile on ground beef and sausage for a hearty meal.', 49.99, 43.49),
(5, 'Margherita Pizza', 'MAP', 'images/Margherita Pizza.jpg', 'Deceptively simple, the Margherita pizza is made with basil, fresh mozzarella, and tomatoes. There''s a reason it''s an Italian staple and one of the most popular types of pizza in the country.', 25.50, 22.19),
(6, 'BBQ Chicken Pizza', 'BCP', 'images/BBQ Chicken Pizza.jpg', 'If you love BBQ chicken and you love pizza, why not put them together? This has long been a cult favorite of sports fans and college kids. The chicken slathered over the top of a pie gives it a tangy, sweet flavor that can''t be beaten.', 35.75, 31.10),
(7, 'Hawaiian Pizza', 'HAP', 'images/Hawaiian Pizza.jpg', 'Pineapple might not be the first thing that comes to mind when you think pizza. But add in some ham and it creates an unexpectedly solid sweet and salty combination for this type of pizza.', 50.00, 43.5),
(8, 'Buffalo Pizza', 'BUP', 'images/Buffalo Pizza.jpg', 'Who says your pizza has to be strictly tomato-sauce based? Branch out with some buffalo sauce on your pie. All its spicy, salty, buttery goodness is a natural pairing for pizza.' , 41.27, 35.90);

--
-- Indexes for table `pizzaproduct`
--
ALTER TABLE `pizzaproduct`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pizzaproduct`
--
ALTER TABLE `pizzaproduct`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;