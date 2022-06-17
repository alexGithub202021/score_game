# we will use node:alpine docker image
FROM node:alpine

# set /app as work directory
WORKDIR /app

# copy your project files to work directoryCOPY . /app

# install npm dependencies
RUN yarn install

# run your app
# CMD ["yarn", "run", "start"]
RUN yarn run start