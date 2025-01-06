build:
  podman build . -t docker.io/rpodgorny/attendance

push: build
  podman push docker.io/rpodgorny/attendance
