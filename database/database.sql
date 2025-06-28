

CREATE TABLE `contact` (
`id` int(11) NOT NULL,
`name` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
`subject` varchar(255) NOT NULL,
`message` varchar(255) NOT NULL
);


CREATE TABLE `users` (
`id` int(11) NOT NULL,
`username` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
`password` varchar(255) NOT NULL
);

ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

  ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;
